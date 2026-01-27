{{-- File Upload Component Examples --}}

{{-- Basic File Upload with Progress --}}
<h3 class="text-lg font-semibold mb-4">Basic File Upload with Progress</h3>

<div class="space-y-4">
    {{-- Standard file upload with progress bar --}}
    <div>
        <h4 class="text-md font-medium mb-2">Standard Upload</h4>
        <x-file.upload 
            label="Choose a file"
            hint="Maximum file size: 5MB"
            max-size="5120"
            show-progress
            progress-color="primary"
            progress-text
            class="mb-4" />
    </div>

    {{-- Multiple file upload --}}
    <div>
        <h4 class="text-md font-medium mb-2">Multiple Files Upload</h4>
        <x-file.upload 
            label="Choose multiple files"
            hint="Select multiple files to upload at once"
            multiple
            show-progress
            progress-color="success"
            progress-text
            max-size="10240"
            class="mb-4" />
    </div>

    {{-- File upload with specific file types --}}
    <div>
        <h4 class="text-md font-medium mb-2">Images Only Upload</h4>
        <x-file.upload 
            label="Choose images"
            hint="Only JPG, PNG, and GIF files are allowed"
            accept="image/jpeg,image/png,image/gif"
            show-progress
            progress-color="info"
            progress-text
            max-size="2048"
            class="mb-4" />
    </div>

    {{-- Compact upload without progress text --}}
    <div>
        <h4 class="text-md font-medium mb-2">Compact Upload</h4>
        <x-file.upload 
            label="Upload file"
            hint="Compact version without percentage text"
            show-progress
            progress-color="warning"
            :progress-text="false"
            class="mb-4" />
    </div>

    {{-- Upload without progress bar --}}
    <div>
        <h4 class="text-md font-medium mb-2">Simple Upload (No Progress)</h4>
        <x-file.upload 
            label="Choose file"
            hint="Basic file upload without progress indicator"
            :show-progress="false"
            max-size="5120"
            class="mb-4" />
    </div>
</div>

{{-- Livewire File Upload Examples --}}
<h3 class="text-lg font-semibold mt-8 mb-4">Livewire File Upload Examples</h3>

<div class="space-y-4">
    {{-- Basic Livewire upload --}}
    <div>
        <h4 class="text-md font-medium mb-2">Livewire Single Upload</h4>
        <x-file.livewire-upload 
            label="Upload document"
            hint="File will be uploaded via Livewire"
            upload-property="document"
            show-progress
            progress-color="primary"
            progress-text
            max-size="10240"
            class="mb-4" />
    </div>

    {{-- Livewire multiple upload --}}
    <div>
        <h4 class="text-md font-medium mb-2">Livewire Multiple Upload</h4>
        <x-file.livewire-upload 
            label="Upload multiple photos"
            hint="Upload multiple images at once"
            upload-property="photos"
            multiple
            accept="image/*"
            show-progress
            progress-color="success"
            progress-text
            max-size="5120"
            class="mb-4" />
    </div>

    {{-- Livewire upload with validation --}}
    <div>
        <h4 class="text-md font-medium mb-2">Livewire Upload with Validation</h4>
        <x-file.livewire-upload 
            label="Profile picture"
            hint="Upload your profile picture (JPG or PNG, max 2MB)"
            upload-property="avatar"
            accept="image/jpeg,image/png"
            show-progress
            progress-color="info"
            progress-text
            max-size="2048"
            required
            class="mb-4" />
    </div>
</div>

{{-- Usage Code Examples --}}
<h3 class="text-lg font-semibold mt-8 mb-4">Usage Examples</h3>

<div class="space-y-6">
    {{-- Basic usage --}}
    <div>
        <h4 class="text-md font-medium mb-2">Basic Usage</h4>
        <pre class="bg-surface-alt dark:bg-surface-dark-alt p-4 rounded-radius text-sm overflow-x-auto">
<code>&lt;x-file.upload 
    label="Choose a file"
    hint="Maximum file size: 5MB"
    max-size="5120"
    show-progress
    progress-color="primary" /&gt;</code>
        </pre>
    </div>

    {{-- Multiple files --}}
    <div>
        <h4 class="text-md font-medium mb-2">Multiple Files</h4>
        <pre class="bg-surface-alt dark:bg-surface-dark-alt p-4 rounded-radius text-sm overflow-x-auto">
<code>&lt;x-file.upload 
    label="Choose multiple files"
    multiple
    show-progress
    progress-color="success"
    max-size="10240" /&gt;</code>
        </pre>
    </div>

    {{-- Livewire usage --}}
    <div>
        <h4 class="text-md font-medium mb-2">Livewire Integration</h4>
        <pre class="bg-surface-alt dark:bg-surface-dark-alt p-4 rounded-radius text-sm overflow-x-auto">
<code>&lt;x-file.livewire-upload 
    label="Upload document"
    upload-property="document"
    show-progress
    progress-color="primary"
    max-size="10240" /&gt;</code>
        </pre>
    </div>

    {{-- Livewire component example --}}
    <div>
        <h4 class="text-md font-medium mb-2">Livewire Component Example</h4>
        <pre class="bg-surface-alt dark:bg-surface-dark-alt p-4 rounded-radius text-sm overflow-x-auto">
<code>class FileUpload extends Component
{
    public $document;
    public $photos = [];

    protected $rules = [
        'document' => 'required|file|max:10240',
        'photos.*' => 'image|max:5120',
    ];

    public function save()
    {
        $this->validate();
        
        // Process uploaded files
        if ($this->document) {
            $path = $this->document->store('documents');
            // Save to database, etc.
        }
        
        foreach ($this->photos as $photo) {
            $path = $photo->store('photos');
            // Process each photo
        }
        
        session()->flash('message', 'Files uploaded successfully!');
    }
}</code>
        </pre>
    </div>
</div>

{{-- Available Props --}}
<h3 class="text-lg font-semibold mt-8 mb-4">Available Props</h3>

<div class="bg-surface-alt dark:bg-surface-dark-alt p-4 rounded-radius">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-outline dark:border-outline-dark">
                <th class="text-left p-2">Prop</th>
                <th class="text-left p-2">Type</th>
                <th class="text-left p-2">Default</th>
                <th class="text-left p-2">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">label</td>
                <td class="p-2">string</td>
                <td class="p-2">null</td>
                <td class="p-2">Label for the file input</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">hint</td>
                <td class="p-2">string</td>
                <td class="p-2">null</td>
                <td class="p-2">Helper text displayed below the input</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">max-size</td>
                <td class="p-2">int</td>
                <td class="p-2">null</td>
                <td class="p-2">Maximum file size in KB</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">multiple</td>
                <td class="p-2">bool</td>
                <td class="p-2">false</td>
                <td class="p-2">Allow multiple file selection</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">accept</td>
                <td class="p-2">string</td>
                <td class="p-2">null</td>
                <td class="p-2">Accepted file types (e.g., "image/*")</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">show-progress</td>
                <td class="p-2">bool</td>
                <td class="p-2">true</td>
                <td class="p-2">Show progress bar during upload</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">progress-color</td>
                <td class="p-2">string</td>
                <td class="p-2">primary</td>
                <td class="p-2">Progress bar color theme</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">progress-text</td>
                <td class="p-2">bool</td>
                <td class="p-2">true</td>
                <td class="p-2">Show percentage text on progress bar</td>
            </tr>
            <tr class="border-b border-outline/50 dark:border-outline-dark/50">
                <td class="p-2 font-mono">upload-property</td>
                <td class="p-2">string</td>
                <td class="p-2">photo</td>
                <td class="p-2">Livewire property name (livewire-upload only)</td>
            </tr>
        </tbody>
    </table>
</div>
