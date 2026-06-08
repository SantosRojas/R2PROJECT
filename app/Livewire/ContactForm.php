<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $message = '';
    public bool $success = false;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }

    public function submit(): void
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'message' => $this->message,
        ]);

        $this->reset();
        $this->success = true;
    }

    public function render()
    {
        return view('components.⚡contact-form');
    }
}
