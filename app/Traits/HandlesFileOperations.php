namespace AppTraits;

use IlluminateSupportFacadesStorage;
use IlluminateSupportStr;
use IlluminateHttpUploadedFile;

trait HandlesFileOperations
{
    /**
     * Upload a file and return the file path.
     *
     * @param  IlluminateHttpUploadedFile  $file
     * @param  string  $folder
     * @param  string|null  $disk
     * @param  string|null  $filename
     * @return string
     */
    public function uploadFile(UploadedFile $file, $folder = 'uploads', $disk = null, $filename = null)
    {
        $disk = $disk ?: config('filesystems.default');
        $filename = $filename ?: $this->generateFileName($file);

        $path = $file->storeAs($folder, $filename, $disk);

        return $path;
    }

    /**
     * Generate a unique file name.
     *
     * @param  IlluminateHttpUploadedFile  $file
     * @return string
     */
    protected function generateFileName(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        return Str::uuid() . '.' . $extension;
    }

    /**
     * Delete a file from the storage.
     *
     * @param  string  $path
     * @param  string|null  $disk
     * @return bool
     */
    public function deleteFile($path, $disk = null)
    {
        $disk = $disk ?: config('filesystems.default');
        return Storage::disk($disk)->delete($path);
    }


    public function uploadFile(UploadedFile $file, $folder = 'uploads', $disk = 'public')
    {
        $filename = time().'_'.$file->getClientOriginalName();
        return $file->storeAs($folder, $filename, $disk);
    }
}