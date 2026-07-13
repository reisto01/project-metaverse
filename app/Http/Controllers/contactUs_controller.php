<?php

namespace App\Http\Controllers;

use App\Mail\contactUs_Mail;
use App\Models\tb_mail;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactUs_controller extends Controller
{
    public function index()
    {
        return view('userpage.contact_us');
    }

    public function faq()
    {
        return view('userpage.faq');
    }

    public function profile(Request $request)
    {
        return view('userpage.profile', ['user' => $request->user()]);
    }

    public function admin_side(Request $request)
    {
        $search = $request->string('search_me')->trim()->toString();
        $messages = tb_mail::where('is_deleted', 1)
            ->when($search, fn ($query) => $query->where('username', 'like', '%'.$search.'%'))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('adminpage.contactUs', [
            'Page' => 'Kelola Email',
            'mail' => $messages,
            'get_total' => $messages->total(),
            'page_now' => $messages->currentPage(),
            'search' => $search,
            'pagin' => $messages->lastPage(),
        ]);
    }

    public function contactUs_post(Request $request)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:5000'],
        ]);

        tb_mail::create([
            'username' => $request->user()->name ?: $request->user()->username,
            'email' => $request->user()->email,
            'message' => $data['message'],
            'status' => 1,
            'is_deleted' => 1,
        ]);

        return redirect('/contactUs')->with('alert-notif', 'Pesan berhasil dikirim');
    }

    public function delete_contact_us(Request $request)
    {
        $data = $request->validate(['id_data' => ['required', 'integer', 'exists:tb_mail,id']]);
        tb_mail::whereKey($data['id_data'])->update(['is_deleted' => 0]);

        return redirect('/contactUs_admin');
    }

    public function answereMail(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'integer', 'exists:tb_mail,id'],
            'reply' => ['required', 'string', 'max:5000'],
        ]);

        $message = tb_mail::where('is_deleted', 1)->findOrFail($data['id']);

        Mail::to($message->email)->queue(new contactUs_Mail([
            'title' => 'Balasan LandMetaverse.com',
            'body' => $data['reply'],
        ]));

        $message->update([
            'status' => 2,
            'answere' => $data['reply'],
        ]);

        return redirect('/contactUs_admin');
    }

    public function getData(int $id)
    {
        $message = tb_mail::where('is_deleted', 1)->findOrFail($id);

        return response()->json([
            'data' => $message->only(['id', 'username', 'email', 'message', 'status', 'answere']),
        ]);
    }

    public function contactUs_print(Request $request)
    {
        $data = $request->validate(['id_data1' => ['required', 'integer', 'exists:tb_mail,id']]);
        $message = tb_mail::where('is_deleted', 1)->findOrFail($data['id_data1']);
        $html = view('adminpage.laporan.downloadLaporan', ['mail' => collect([$message])])->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="contact-message-report.pdf"',
        ]);
    }
}
