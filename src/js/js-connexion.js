const loginForm = document.querySelector('#login-form');
const errorMessage = document.querySelector('#error-message');

loginForm.addEventListener('submit', e => {
  e.preventDefault();
  
  const formData = new FormData(loginForm);
  const jsonData = JSON.stringify(Object.fromEntries(formData));
  
  fetch('login.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: jsonData
  })
  .then(response => {
    if (response.ok) {
      return response.json();
    } else {
      throw new Error('Erreur réseau');
    }
  })
  .then(data => {
    if (data.success) {
      window.location.href = 'accueil.php';
    } else {
      errorMessage.textContent = data.message;
    }
  })
  .catch(error => {
    errorMessage.textContent = error.message;
  });
});


