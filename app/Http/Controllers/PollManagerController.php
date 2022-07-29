<?php

namespace App\Http\Controllers;

use App\Models\PollAnswer;
use App\Models\PollChoice;
use App\Models\PollDescription;
use App\SessionManager;
use Illuminate\Http\Request;

class PollManagerController extends Controller
{
    public function createIndex(Request $request)
    {
        return view('poll/create', [
            'option' => $request->option
        ]);
    }

    public function createAddItem(Request $request)
    {
        $data = [
            'user_id' => SessionManager::getSession()->aud,
            'poll_name' => $request->name
        ];
        $id = PollDescription::create($data)->id;

        for ($i = 0; $i < $request->option; $i++) {
            $data = [
                'poll_description_id' => $id,
                'poll_choice_name' => $request->input('poll_choice_name_' . $i)
            ];
            PollChoice::create($data);
        }

        return view('poll/createAddItem', ['id' => $id]);
    }

    public function stagesIndex(Request $request)
    {
        $id = $request->id;
        if (empty($id)) return redirect()->route('index')->with('redirect_message', 'Poll tidak ditemukan!');
        $data = PollDescription::with('PollChoices')->findOrFail($id);

        // Ambil data semisal sudah vote
        $result = PollAnswer::with('PollChoices')->where('poll_description_id', $id);
        $is_voted = $result->get()->where('user_id', SessionManager::getSession()->aud)->count() > 0;
        $option_list = PollChoice::where('poll_description_id', $id)->get();

        $percentage = [];
        $total_data = $result->count();
        foreach ($option_list as $v) {
            // Ubah dulu jadi collection karena quernya masih dalam posisi chained
            $count = $result->get()->where('poll_choice_id', $v->id)->count();
            array_push($percentage, [
                'name' => $v->poll_choice_name,
                'percentage' => $total_data == 0 ? 0 : ($count / $total_data) * 100,
                'count' => $count
            ]);
        }

        return view('poll/stages', [
            'data' => $data,
            'poll_id' => $id,
            'is_voted' => $is_voted,
            'percentage' => $percentage
        ]);
    }

    public function stagesAddAnswer(Request $request)
    {
        $answer = $request->poll_choice;
        $poll_id = $request->poll_id;
        $data = [
            'user_id' => SessionManager::getSession()->aud,
            'poll_description_id' => $poll_id,
            'poll_choice_id' => $answer
        ];
        PollAnswer::create($data);
        return redirect()->route('poll.stages', ['id' => $poll_id])->with('redirect_message', 'Jawabanmu berhasil terekam!');
    }

    public function listIndex()
    {
        $data = PollDescription::orderBy('id', 'DESC')
            ->where('user_id', SessionManager::getSession()->aud)->get();
        return view('poll/list', ['data' => $data]);
    }

    public function listDeletePoll(Request $request)
    {
        PollDescription::deleteData($request->id);
        return redirect()->route('poll.list')->with('redirect_message', 'Poll berhasil dihapus!');
    }
}
