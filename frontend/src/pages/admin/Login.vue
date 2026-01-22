<template>
  <div
    class="flex flex-center"
    style="min-height: 100vh; background-color: #f5f5f5;"
  >
    <q-card class="login-card q-pa-md" style="width: 100%; max-width: 400px;">
      <q-card-section class="text-center q-pb-none">
        <q-img
          src="/images/faan-logo.png"
          alt="FAAN Logo"
          style="max-width: 120px;"
          class="q-mb-md"
        />
        <div class="text-h5 text-weight-medium">Admin Login</div>
        <div class="text-grey-7 q-mt-xs">Sign in to access the dashboard</div>
      </q-card-section>

      <q-card-section>
        <q-form @submit.prevent="handleLogin" class="q-gutter-y-md">
          <q-input
            v-model="form.email"
            type="email"
            label="Email"
            outlined
            dense
            :rules="[
              (val) => !!val || 'Email is required',
              (val) => isValidEmail(val) || 'Please enter a valid email',
            ]"
          >
            <template v-slot:prepend>
              <q-icon name="email" color="grey-7" />
            </template>
          </q-input>

          <q-input
            v-model="form.password"
            :type="showPassword ? 'text' : 'password'"
            label="Password"
            outlined
            dense
            :rules="[(val) => !!val || 'Password is required']"
          >
            <template v-slot:prepend>
              <q-icon name="lock" color="grey-7" />
            </template>
            <template v-slot:append>
              <q-icon
                :name="showPassword ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                color="grey-7"
                @click="showPassword = !showPassword"
              />
            </template>
          </q-input>

          <q-btn
            type="submit"
            label="Sign In"
            color="primary"
            class="full-width q-mt-md"
            :loading="loading"
            no-caps
          />
        </q-form>
      </q-card-section>

      <q-card-section class="text-center q-pt-none">
        <router-link to="/" class="text-primary text-caption">
          &larr; Back to website
        </router-link>
      </q-card-section>
    </q-card>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import { Notify } from "quasar";
import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";

const router = useRouter();
const store = useStore();

const form = ref({
  email: "",
  password: "",
});

const showPassword = ref(false);
const loading = ref(false);

const isValidEmail = (val) => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(val);
};

const handleLogin = async () => {
  loading.value = true;

  try {
    const response = await callApi({
      path: "/admin/login",
      method: "post",
      payload: {
        email: form.value.email,
        password: form.value.password,
      },
    });

    if (response && response.status === "ok") {
      store.token = response.token;
      store.user = response.user;

      Notify.create({
        type: "positive",
        message: "Login successful!",
      });

      router.push({ name: "admin-index" });
    } else if (response && response.status === "error") {
      Notify.create({
        type: "negative",
        message: response.message || "Invalid credentials",
      });
    }
  } catch (error) {
    console.error("Login error:", error);
    Notify.create({
      type: "negative",
      message: "An error occurred. Please try again.",
    });
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.login-card {
  border-radius: 8px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
}
</style>
