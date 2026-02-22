@extends('layouts.admin')

@section('title', 'Pengaturan Akun - Aorta Malang')

@push('styles')
<style>
    .profile-container {
        max-width: 600px;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: var(--shadow);
    }
    .form-section {
        margin-bottom: 30px;
    }
    .form-section h2 {
        font-size: 1.2rem;
        color: var(--primary);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    /* Real-time Validation Styles */
    .validation-msg {
        font-size: 0.85rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(-5px);
        height: 0;
        overflow: hidden;
    }

    .validation-msg.show {
        opacity: 1;
        transform: translateY(0);
        height: auto;
        margin-top: 8px;
    }

    .validation-msg.valid {
        color: #28a745;
    }

    .validation-msg.invalid {
        color: #dc3545;
    }

    .form-group input {
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-group input.is-valid {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.1);
    }

    .form-group input.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }

    .shake {
        animation: shake 0.3s ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <h1 class="page-title">Pengaturan Akun</h1>
</div>

<div class="profile-container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-section">
        <h2>Ganti Password</h2>
        <form action="{{ route('admin.profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" name="current_password" id="current_password" required>
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" required>
                <div id="password-length-msg" class="validation-msg">
                    <i class="fas fa-info-circle"></i>
                    <span>Minimal 8 karakter.</span>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <div id="password-match-msg" class="validation-msg">
                    <i class="fas fa-check-circle"></i>
                    <span>Password cocok.</span>
                </div>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const lengthMsg = document.getElementById('password-length-msg');
    const matchMsg = document.getElementById('password-match-msg');
    const lengthIcon = lengthMsg.querySelector('i');
    const lengthText = lengthMsg.querySelector('span');
    const matchIcon = matchMsg.querySelector('i');
    const matchText = matchMsg.querySelector('span');

    function updateValidation() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;

        // Length Validation
        if (password.length > 0) {
            lengthMsg.classList.add('show');
            if (password.length >= 8) {
                lengthMsg.className = 'validation-msg show valid';
                lengthIcon.className = 'fas fa-check-circle';
                lengthText.textContent = 'Panjang password sudah sesuai.';
                passwordInput.classList.remove('is-invalid');
                passwordInput.classList.add('is-valid');
            } else {
                lengthMsg.className = 'validation-msg show invalid';
                lengthIcon.className = 'fas fa-times-circle';
                lengthText.textContent = 'Minimal 8 karakter.';
                passwordInput.classList.remove('is-valid');
                passwordInput.classList.add('is-invalid');
            }
        } else {
            lengthMsg.classList.remove('show');
            passwordInput.classList.remove('is-valid', 'is-invalid');
        }

        // Match Validation
        if (confirm.length > 0) {
            matchMsg.classList.add('show');
            if (password === confirm && password.length >= 8) {
                matchMsg.className = 'validation-msg show valid';
                matchIcon.className = 'fas fa-check-circle';
                matchText.textContent = 'Password cocok.';
                confirmInput.classList.remove('is-invalid');
                confirmInput.classList.add('is-valid');
            } else if (password !== confirm) {
                matchMsg.className = 'validation-msg show invalid';
                matchIcon.className = 'fas fa-times-circle';
                matchText.textContent = 'Password tidak cocok.';
                confirmInput.classList.remove('is-valid');
                confirmInput.classList.add('is-invalid');
            } else if (password.length < 8) {
                // If they match but length is too short, keep it invalid
                matchMsg.className = 'validation-msg show invalid';
                matchIcon.className = 'fas fa-times-circle';
                matchText.textContent = 'Password harus minimal 8 karakter.';
                confirmInput.classList.remove('is-valid');
                confirmInput.classList.add('is-invalid');
            }
        } else {
            matchMsg.classList.remove('show');
            confirmInput.classList.remove('is-valid', 'is-invalid');
        }
    }

    passwordInput.addEventListener('input', updateValidation);
    confirmInput.addEventListener('input', updateValidation);

    // Initial check (in case of browser autofill)
    updateValidation();
});
</script>
@endsection
