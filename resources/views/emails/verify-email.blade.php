@component('mail::message')
    <div style="display: flex; justify-content: center;">
        <p>Thank you for registering</p>

        <p style="font-size: 1.2rem">Verify your account</p>
    </div>

    {{-- Action Button --}}
    @isset($actionText)
    <?php
        switch ($level) {
            case 'success':
            case 'error':
                $color = $level;
                break;
            default:
                $color = 'primary';
        }
    ?>

    @component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
        <p style="font-style: normal; font-weight: 600; font-size: 16px; margin-top: 8px; margin-bottom: 8px;">
            {{ $actionText }}
        </p>
    @endcomponent

    @endisset
@endcomponent