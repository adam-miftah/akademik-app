<template>
  <div class="body">
    <div class="container">
      <div class="formlogin">
        <h1 class="text-center fw-bold mb-4">Login</h1>

        <form @submit.prevent="login" method="post">
          <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email</label>
            <input v-model="email" type="email" class="form-control" id="exampleInputEmail"
              placeholder="Masukkan Email Anda" required
              title="Masukkan Email Anda" />
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input v-model="password" type="password" class="form-control"
              id="exampleInputPassword1" placeholder="Password" required />
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2';
import 'animate.css';

export default {
  name: 'LoginView',
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await fetch('http://akademik-app.test//api/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json'
          },
          body: JSON.stringify({
            email: this.email,
            password: this.password
          })
        });

        const data = await response.json();

        if (response.ok && data.token) {
          localStorage.setItem('token', data.token);
          localStorage.setItem('role', data.user.role);

          Swal.fire({
            title: 'Login Berhasil!',
            text: `Halo ${data.user.name} 👋`,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
          });

          setTimeout(() => {
            const role = data.user.role;
            if (role === 'admin') {
              this.$router.push('/AdminHome');
            } else if (role === 'dosen') {
              this.$router.push('/DosenHome');
            } else if (role === 'mahasiswa') {
              this.$router.push('/HomeView');
            }
          }, 1600);
        } else {
          Swal.fire({
            title: 'Login Gagal!',
            text: data.message || 'Email atau password salah.',
            icon: 'error',
            timer: 2000,
            showConfirmButton: false
          });
        }
      } catch (error) {
        console.error(error);
        Swal.fire('Terjadi kesalahan saat login.', '', 'error');
      }
    }
  }
};
</script>

<style scoped>
.body {
  background-image: url('/public/image/background.jpg');
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.formlogin {
  max-width: 400px;
  width: 100%;
  margin: auto;
  margin-top: 85px;
  color: white;
  border: 2px solid white;
  backdrop-filter: blur(10px);
  border-radius: 18px;
  padding: 20px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
  background: rgba(255, 255, 255, 0.1);
}

input.form-control {
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
  border-radius: 8px;
  padding: 10px;
  font-size: 16px;
}

input.form-control:focus {
  border-color: white;
  box-shadow: 0 0 10px #007bff, 0 0 8px rgba(0, 91, 187, 0.5);
}

button.btn {
  color: white;
  border-radius: 8px;
  padding: 10px 20px;
  font-size: 18px;
  box-shadow: 0px 3px 2px rgba(0, 0, 0, 0.5);
}

.container {
  width: 100%;
}

.w-25 {
  width: 100%;
}
</style>
