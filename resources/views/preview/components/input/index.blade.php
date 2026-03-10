@props([
    'props' => [],
])

<div class="preview w-full p-6">
    <div class="mx-auto grid w-full max-w-xl gap-5">
        <x-ui.input
            name="email"
            label="Email"
            type="email"
            placeholder="name@example.com"
            icon="mail"
            helper-text="We will never share your email."
        />

        <x-ui.input
            name="password"
            label="Password"
            type="password"
            placeholder="••••••••"
            :show-password-toggle="true"
        />
    </div>
</div>
