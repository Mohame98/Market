export { handleSubmit, sendForm };

// watchlist handling
async function handleSubmit(event) {
    event.preventDefault();
    const form = event.currentTarget;
    const actionUrl = form.action;
    const formMethod = form.method;
    await sendForm(actionUrl, formMethod, form);
}

function toggleHeartIcon(button, isAdded) {
    const icon = button.querySelector('i');
    if (!isAdded) {
        icon.classList.remove('fa-solid');
        icon.classList.add('fa-regular');
    } else {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid');
    }
}

function displayMessage(form, flash, message) {
    form.style.position = 'relative';
    const messageP = document.createElement("span");
    messageP.classList.add(flash);
    messageP.textContent = message
    form.insertAdjacentElement('afterend', messageP);
    requestAnimationFrame(() => {
        messageP.classList.add('shows');
    });
    setTimeout(() => {
        messageP.classList.remove('shows');
        messageP.classList.add('hide');
        setTimeout(() => {
            messageP.remove();
        }, 400); 
    }, 1300);
}

async function sendForm(actionUrl, formMethod, form) {
    const formData = new FormData(form);
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta
        ? csrfTokenMeta.getAttribute("content")
        : "";

    const options = {
        method: formMethod,
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": csrfToken,
        },
    };

    try {
        const res = await fetch(actionUrl, options);
        const result = await res.json();
        if (!res.ok) { displayMessage(form, 'err', 'An error occurred.');
            return;
        }
        displayMessage(form, 'flash', result.message);
        const button = form.querySelector('button');
        const isAdded = result.isAdded; 
        toggleHeartIcon(button, isAdded);
    } catch (err) {
        console.error('Network Error:', err);
        displayMessage(form, 'err', 'Network error occurred.');
    }
}