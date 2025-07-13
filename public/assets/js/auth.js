document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-auth");
  const errorDiv = document.querySelector(".error-message");
  const successDiv = document.querySelector(".success-message");

  // Deteksi apakah ini form register atau login
  const isRegisterForm = document.querySelector("[name='nama']") !== null;
  const isLoginForm =
    document.querySelector("[name='email']") !== null && !isRegisterForm;

  // Input fields untuk register
  const registerFields = {
    nama: document.querySelector("[name='nama']"),
    email: document.querySelector("[name='email']"),
    no_hp: document.querySelector("[name='no_hp']"),
    password: document.querySelector("[name='password']"),
    confirmPassword: document.getElementById("tpassword"),
  };

  // Input fields untuk login
  const loginFields = {
    email: document.querySelector("[name='email']"),
    password: document.querySelector("[name='password']"),
  };

  // Pilih input fields berdasarkan jenis form
  const inputFields = isRegisterForm ? registerFields : loginFields;

  // Auto-hide error/success messages
  if (errorDiv) {
    setTimeout(() => {
      errorDiv.style.transition = "opacity 0.5s ease";
      errorDiv.style.opacity = 0;

      // Setelah animasi selesai, sembunyikan elemen
      setTimeout(() => {
        errorDiv.style.display = "none";
      }, 500);
    }, 3500);
  }

  if (successDiv) {
    setTimeout(() => {
      successDiv.style.transition = "opacity 0.5s ease";
      successDiv.style.opacity = 0;

      // Setelah animasi selesai, sembunyikan elemen
      setTimeout(() => {
        successDiv.style.display = "none";
      }, 500);
    }, 3500);
  }

  // Fungsi untuk trigger shake effect yang reliable
  function triggerShake(element) {
    element.classList.remove("shake");
    // Force reflow dengan requestAnimationFrame untuk lebih reliable
    requestAnimationFrame(() => {
      element.classList.add("shake");
      setTimeout(() => element.classList.remove("shake"), 500);
    });
  }

  // Reset dan beri feedback visual
  function setValidationStyle(input, isValid) {
    input.classList.remove("error", "success");
    if (isValid) {
      input.classList.add("success");
    } else {
      input.classList.add("error");
      triggerShake(input);
    }
  }

  // Validasi email format
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  // Validasi nomor HP
  function isValidPhone(phone) {
    const phoneRegex = /^[0-9]{10,15}$/;
    return phoneRegex.test(phone);
  }

  // Validasi untuk form register
  function validateRegisterFields() {
    let isValid = true;

    // Nama
    if (
      inputFields.nama.value.trim() === "" ||
      inputFields.nama.value.trim().length < 2
    ) {
      setValidationStyle(inputFields.nama, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.nama, true);
    }

    // Email
    if (
      inputFields.email.value.trim() === "" ||
      !isValidEmail(inputFields.email.value.trim())
    ) {
      setValidationStyle(inputFields.email, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.email, true);
    }

    // No HP
    if (
      inputFields.no_hp.value.trim() === "" ||
      !isValidPhone(inputFields.no_hp.value.trim())
    ) {
      setValidationStyle(inputFields.no_hp, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.no_hp, true);
    }

    // Password
    if (inputFields.password.value.length < 8) {
      setValidationStyle(inputFields.password, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.password, true);
    }

    // Confirm Password
    if (
      inputFields.confirmPassword.value !== inputFields.password.value ||
      inputFields.confirmPassword.value === ""
    ) {
      setValidationStyle(inputFields.confirmPassword, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.confirmPassword, true);
    }

    return isValid;
  }

  // Validasi untuk form login
  function validateLoginFields() {
    let isValid = true;

    // Email
    if (
      inputFields.email.value.trim() === "" ||
      !isValidEmail(inputFields.email.value.trim())
    ) {
      setValidationStyle(inputFields.email, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.email, true);
    }

    // Password
    if (inputFields.password.value.trim() === "") {
      setValidationStyle(inputFields.password, false);
      isValid = false;
    } else {
      setValidationStyle(inputFields.password, true);
    }

    return isValid;
  }

  // Pilih fungsi validasi berdasarkan jenis form
  const validateFields = isRegisterForm
    ? validateRegisterFields
    : validateLoginFields;

  // Validasi real-time saat user mengetik
  Object.values(inputFields).forEach((input) => {
    if (input) {
      // Pastikan element ada
      input.addEventListener("blur", validateFields);
      input.addEventListener("input", function () {
        // Hapus style error/success saat user mulai mengetik
        this.classList.remove("error", "success", "shake");
      });
    }
  });

  // Handle form submit
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    if (isRegisterForm) {
      handleRegisterSubmit();
    } else if (isLoginForm) {
      handleLoginSubmit();
    }
  });

  // Handle register form submit
  function handleRegisterSubmit() {
    let allValid = true;

    // Nama
    if (
      inputFields.nama.value.trim() === "" ||
      inputFields.nama.value.trim().length < 2
    ) {
      inputFields.nama.classList.add("error");
      triggerShake(inputFields.nama);
      allValid = false;
    } else {
      inputFields.nama.classList.remove("error");
      inputFields.nama.classList.add("success");
    }

    // Email
    if (
      inputFields.email.value.trim() === "" ||
      !isValidEmail(inputFields.email.value.trim())
    ) {
      inputFields.email.classList.add("error");
      triggerShake(inputFields.email);
      allValid = false;
    } else {
      inputFields.email.classList.remove("error");
      inputFields.email.classList.add("success");
    }

    // No HP
    if (
      inputFields.no_hp.value.trim() === "" ||
      !isValidPhone(inputFields.no_hp.value.trim())
    ) {
      inputFields.no_hp.classList.add("error");
      triggerShake(inputFields.no_hp);
      allValid = false;
    } else {
      inputFields.no_hp.classList.remove("error");
      inputFields.no_hp.classList.add("success");
    }

    // Password
    if (inputFields.password.value.length < 8) {
      inputFields.password.classList.add("error");
      triggerShake(inputFields.password);
      allValid = false;
    } else {
      inputFields.password.classList.remove("error");
      inputFields.password.classList.add("success");
    }

    // Confirm Password
    if (
      inputFields.confirmPassword.value !== inputFields.password.value ||
      inputFields.confirmPassword.value === ""
    ) {
      inputFields.confirmPassword.classList.add("error");
      triggerShake(inputFields.confirmPassword);
      allValid = false;
    } else {
      inputFields.confirmPassword.classList.remove("error");
      inputFields.confirmPassword.classList.add("success");
    }

    // Submit jika semua valid dengan konfirmasi SweetAlert
    if (allValid) {
      Swal.fire({
        title: "Yakin data sudah benar?",
        text: "Pastikan semua informasi yang kamu isi sudah sesuai.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Daftar",
        cancelButtonText: "Periksa Lagi",
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    }
  }

  // Handle login form submit
  function handleLoginSubmit() {
    let allValid = true;

    // Email
    if (
      inputFields.email.value.trim() === "" ||
      !isValidEmail(inputFields.email.value.trim())
    ) {
      inputFields.email.classList.add("error");
      triggerShake(inputFields.email);
      allValid = false;
    } else {
      inputFields.email.classList.remove("error");
      inputFields.email.classList.add("success");
    }

    // Password
    if (inputFields.password.value.trim() === "") {
      inputFields.password.classList.add("error");
      triggerShake(inputFields.password);
      allValid = false;
    } else {
      inputFields.password.classList.remove("error");
      inputFields.password.classList.add("success");
    }

    // Submit jika semua valid (langsung submit tanpa konfirmasi)
    if (allValid) {
      form.submit();
    }
  }
});
