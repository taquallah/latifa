<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-top: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        button:hover {
            background-color: #3367d6;
        }
        .login-link {
            display: block;
            margin-top: 15px;
            text-align: center;
        }
        .forgot-link {
            display: block;
            margin-top: 10px;
            text-align: right;
            font-size: 14px;
            color: #4285f4;
            text-decoration: none;
        }
        .message {
            padding: 10px;
            border-radius: 4px;
            margin: 15px 0;
            display: none;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Login Form -->
    <div id="login-container" class="container">
        <h1>Login</h1>
        <form id="login-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" required>
            </div>
            <a href="#" class="forgot-link" id="forgot-password-link">Forgot password?</a>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Forgot Password Form -->
    <div id="forgot-container" class="container hidden">
        <h1>Forgot Password</h1>
        <p>Enter your email address and we'll send you a link to reset your password.</p>
        <form id="forgot-form">
            <div class="form-group">
                <label for="forgot-email">Email</label>
                <input type="email" id="forgot-email" placeholder="Enter your email" required>
            </div>
            <div class="message" id="forgot-message"></div>
            <button type="submit">Send Reset Link</button>
            <a href="#" class="login-link" id="back-to-login">Back to login</a>
        </form>
    </div>

    <!-- Reset Password Form -->
    <div id="reset-container" class="container hidden">
        <h1>Reset Password</h1>
        <p>Please enter your new password below.</p>
        <form id="reset-form">
            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" placeholder="Enter new password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" placeholder="Confirm new password" required>
            </div>
            <div class="message" id="reset-message"></div>
            <button type="submit">Reset Password</button>
        </form>
    </div>

    <script>
        // DOM elements
        const loginContainer = document.getElementById('login-container');
        const forgotContainer = document.getElementById('forgot-container');
        const resetContainer = document.getElementById('reset-container');
        const forgotPasswordLink = document.getElementById('forgot-password-link');
        const backToLoginLink = document.getElementById('back-to-login');
        const forgotForm = document.getElementById('forgot-form');
        const resetForm = document.getElementById('reset-form');
        const forgotMessage = document.getElementById('forgot-message');
        const resetMessage = document.getElementById('reset-message');

        // Show forgot password form
        forgotPasswordLink.addEventListener('click', function(e) {
            e.preventDefault();
            loginContainer.classList.add('hidden');
            forgotContainer.classList.remove('hidden');
            resetContainer.classList.add('hidden');
            document.getElementById('forgot-email').value = document.getElementById('email').value;
        });

        // Go back to login
        backToLoginLink.addEventListener('click', function(e) {
            e.preventDefault();
            loginContainer.classList.remove('hidden');
            forgotContainer.classList.add('hidden');
            resetContainer.classList.add('hidden');
        });

        // Handle forgot password form submission
        forgotForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('forgot-email').value;
            
            // This would typically be an API call to your backend
            // For demo purposes, we'll just simulate a success response
            forgotMessage.textContent = `Password reset link sent to ${email}. Check your inbox.`;
            forgotMessage.className = 'message success';
            forgotMessage.style.display = 'block';
            
            // In a real app, we'd wait for the email to be clicked
            // For this demo, we'll automatically show the reset form after 2 seconds
            setTimeout(() => {
                forgotContainer.classList.add('hidden');
                resetContainer.classList.remove('hidden');
            }, 2000);
        });

        // Handle reset password form submission
        resetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Check if passwords match
            if (newPassword !== confirmPassword) {
                resetMessage.textContent = 'Passwords do not match!';
                resetMessage.className = 'message error';
                resetMessage.style.display = 'block';
                return;
            }
            
            // Password validation - must be at least 8 characters
            if (newPassword.length < 8) {
                resetMessage.textContent = 'Password must be at least 8 characters long!';
                resetMessage.className = 'message error';
                resetMessage.style.display = 'block';
                return;
            }
            
            // This would be an API call to your backend in a real app
            // For demo purposes, we'll simulate a success response
            resetMessage.textContent = 'Password successfully reset!';
            resetMessage.className = 'message success';
            resetMessage.style.display = 'block';
            
            // Redirect to login after 2 seconds
            setTimeout(() => {
                resetContainer.classList.add('hidden');
                loginContainer.classList.remove('hidden');
                resetForm.reset();
            }, 2000);
        });
    </script>
</body>
</html>