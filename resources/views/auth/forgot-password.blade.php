<!--headerを追加-->
<header class="w-full fixed top-0 left-0 z-50 px-8 py-4 bg-white shadow-md flex justify-between items-center">
      <a href="{{ route('hospital.index') }}" class="text-base text-gray-800 font-bold hover:underline">
          精神科評価サイト
      </a>
      <a href="{{ route('admin.login.form') }}" class="text-base text-gray-800 font-bold hover:underline">
          管理者ログイン
      </a>
  </header>
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<!--footerを追加-->
<footer class="bg-white text-center py-6 fixed bottom-0 z-50 w-full">
      <a href="{{ route('hospital.index') }}" class="text-base tetext-gray-800 font-bold hover:underline">
          精神科評価サイト
      </a>
  </footer