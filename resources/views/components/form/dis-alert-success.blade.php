@session('status')
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
        {{ $attributes->merge(['class' => 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded']) }}
        role="alert">
        {{ $value }}
    </div>
@endsession
