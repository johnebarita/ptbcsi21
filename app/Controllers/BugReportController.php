<?php


namespace App\Controllers;


use App\Models\Eloquent\BugReport;
use http\Client\Request;

class BugReportController extends BaseController
{
    public function index()
    {
        $data['bugs'] = BugReport::all();
        return $this->blade->run('bug-report.bug_report', $data);
    }

    public function create()
    {
        $newName = "";

        if ($file = $this->request->getFile('reference')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('../public/uploads', $newName);
            }
        }

        $bug = BugReport::create([
            'bug' => $_POST['bug'],
            'tester' => $_POST['tester'],
            'urgency' => $_POST['urgency'],
            'date_reported' => $_POST['date_reported'],
            'remarks' => $_POST['status'],
            'reference' => $newName,

        ]);

        $key = ($bug->wasRecentlyCreated ? "success" : "danger");
        $message = ($bug->wasRecentlyCreated ? "Bug Report added successfully!" : "There was a problem while uploading the report!");
        return redirect()->route('bug-report.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $bug = BugReport::find($_POST['id']);
        $bug->bug = $_POST['bug'];
        $bug->tester = $_POST['tester'];
        $bug->urgency = $_POST['urgency'];
        $bug->date_reported = $_POST['date_reported'];
        $bug->remarks = $_POST['status'];
        $newName = $bug->reference;


        if ($file = $this->request->getFile('reference')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('../public/uploads', $newName);
                unlink("../public/uploads/" . $bug->reference);
            }
        }

        $bug->reference = $newName;
        $status = $bug->save();

        $key = ($status ? "success" : "danger");
        $message = ($status ? "Bug Report updated successfully!" : "There was a problem while updating the report!");
        return redirect()->route('bug-report.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function fixed()
    {
        $bug = BugReport::find($_POST['id']);
        $bug->remarks = 'Done';
        $bug->note = $_POST['note'];
        $status = $bug->save();

        $key = ($status ? "success" : "danger");
        $message = ($status ? "Bug Report updated successfully!" : "There was a problem while updating the report!");
        return redirect()->route('bug-report.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function delete()
    {
        $bug = BugReport::find($_POST['id']);
        unlink("../public/uploads/" . $bug->reference);
        $status = $bug->delete();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Bug Report deleted successfully!" : "There was a problem while deleting the report!");
        return redirect()->route('bug-report.index')->with('status', ['key' => $key, 'message' => $message]);
    }

}