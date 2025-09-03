<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
    }

    .unavailable-container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .unavailable-content {
        background-color: white;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .unavailable-image {
        width: 100%;
        height: 250px;
        background-image: url('{{ asset('vendor/img/lebify/application/invalidApplication.svg') }}');
        background-size: 100%;
        background-position: top;
        background-repeat: no-repeat;
    }

    .unavailable-text {
        padding: 2.5rem;
        text-align: center;
    }

    .unavailable-icon {
        font-size: 3.5rem;
        color: #ffc107;
        margin-bottom: 1.5rem;
    }

    .unavailable-title {
        font-size: 2.8rem;
        color: #212529;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .unavailable-message {
        font-size: 1.3rem;
        color: #495057;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .unavailable-button {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        color: white;
        background-color: #007bff;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .unavailable-button:hover {
        background-color: #0056b3;
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
    }

    @media (max-width: 768px) {
        .unavailable-content {
            margin: 15px;
        }

        .unavailable-image {
            height: 200px;
        }

        .unavailable-text {
            padding: 2rem;
        }

        .unavailable-title {
            font-size: 2.2rem;
        }

        .unavailable-message {
            font-size: 1.1rem;
        }

        .unavailable-button {
            padding: 0.9rem 1.8rem;
            font-size: 1rem;
        }
    }
</style>

<div class="unavailable-container">
    <div class="unavailable-content">
        <div class="unavailable-image"></div>
        <div class="unavailable-text">
            <div class="unavailable-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h1 class="unavailable-title">Nice Try, Rookie!</h1>
            <p class="unavailable-message">
                Trying to access this page directly through the URL? That's a classic beginner move! 😉<br>
                This application is still under development, and we've got some tricks up our sleeves.<br>
                Come back when you've leveled up your skills!
            </p>
            <button class="unavailable-button" onclick="window.history.back()">Go Back and Try Again</button>
        </div>
    </div>
</div>
