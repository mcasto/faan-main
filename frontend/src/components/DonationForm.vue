<template>
  <div>
    <q-form @submit.prevent="submit">
      <q-card>
        <q-toolbar>
          <q-toolbar-title>
            {{ store.donations.formTitle }}
          </q-toolbar-title>
        </q-toolbar>
        <div class="text-subtitle1 q-ml-md">
          {{ store.donations.formDisclaimer }}
        </div>
        <q-separator spaced></q-separator>
        <q-card-section class="text-h6">
          {{ store.donations.donationMethodHeader }}
          <div>
            <template
              v-for="(method, idx) of store.donations.donationMethods"
              :key="`donation-method-${idx}`"
            >
              <q-radio
                v-model="form.donation_method"
                :label="method.label"
                :val="method.value"
                class="q-mx-md"
              />
            </template>
          </div>
          <q-separator spaced></q-separator>
          <div class="column q-gutter-y-sm">
            <q-input
              type="text"
              :label="store.donations.formFields.name"
              stack-label
              dense
              outlined
              required
              v-model="form.name"
            ></q-input>
            <q-input
              type="email"
              :label="store.donations.formFields.email"
              stack-label
              dense
              outlined
              required
              v-model="form.email"
            ></q-input>
            <q-input
              type="number"
              :label="store.donations.formFields.amount"
              stack-label
              dense
              outlined
              required
              v-model="form.amount"
            ></q-input>
            <q-checkbox
              :label="store.donations.formFields.consent"
              v-model="form.consent"
              class="text-subtitle2"
            ></q-checkbox>
          </div>
        </q-card-section>
        <q-card-section class="text-center text-caption">
          <div v-html="store.donations.recaptchaDisclaimer"></div>
        </q-card-section>

        <q-card-actions class="justify-end">
          <q-btn
            :label="store.donations.formButtons.cancel"
            color="teal-3 text-black"
            @click="cancel"
          ></q-btn>
          <q-btn
            :label="store.donations.formButtons.continue"
            color="teal-8"
            :disable="
              !form.name || !form.email || form.amount <= 0 || !form.consent
            "
            @click="submit"
          ></q-btn>
        </q-card-actions>
      </q-card>
    </q-form>
  </div>
</template>

<script setup>
import { Loading, Notify } from "quasar";
import { useStore } from "src/stores/store";
import { ref } from "vue";

const store = useStore();

const form = ref({
  donation_method: "cc",
  name: "test",
  email: "test@example.com",
  amount: 1,
  consent: true,
});

const cancel = () => {
  form.value = {
    donation_method: null,
    name: null,
    email: null,
    amount: 0,
    consent: false,
  };
};

const submit = async () => {
  if (!window.grecaptcha) {
    console.error("reCAPTCHA not loaded");
    return;
  }

  Loading.show({ delay: 500 });

  try {
    const token = await grecaptcha.execute(
      "6LdxjJ0pAAAAAHexaPVRXnCvMVw5c7muIPcKJ7w9",
      {
        action: "donation_submit",
      }
    );

    store.submitForm({ path: "/donations", token, formData: form.value });
  } catch (error) {
    console.error("reCAPTCHA failed:", error);
    Notify.create({
      type: "negative",
      message: "Verification failed. Please try again.",
    });

    Loading.hide();
  }
};
</script>
