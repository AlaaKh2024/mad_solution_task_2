namespace AppHttpControllers;

use App\Traits\HandlesFileOperations;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class FileController extends Controller
{
    use HandlesFileOperations;

    public function upload(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $path = $this->uploadFile($file, 'certificates', 'public');
            $user->certificate = $path;
        } elseif ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $this->uploadFile($file, 'images', 'public');
            $user->image = $path;
        } else {
            return response()->json(['message' => 'No file uploaded.'], 400);
        }

        $user->save();

        return response()->json(['message' => 'File uploaded successfully.', 'path' => $path], 201);
    }


    public function delete(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $certificatePath = $user->certificate;

        if ($certificatePath && Storage::disk('public')->exists($certificatePath)) {
            $this->deleteFile($certificatePath, 'public');
            $user->certificate = null;
            $user->save();

            return response()->json(['message' => 'Certificate file deleted and user record updated.'], 200);
        }

        return response()->json(['message' => 'Certificate file not found.'], 404);
    }
}