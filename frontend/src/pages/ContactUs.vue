<template>
  <div class="q-pa-md">
    <div class="text-center text-h6">
      {{ store.contact.header }}
    </div>
    <q-card>
      <q-card-section>
        <div class="row">
          <div class="col-12 col-md-6" v-if="Screen.gt.sm">
            <q-img :src="store.contact.image"></q-img>
          </div>
          <div class="col-12 col-md-6">
            <div class="text-h6 text-center">
              {{ store.contact.phone.header }}
            </div>
            <q-separator spaced></q-separator>
            <div class="flex flex-center">
              <q-list dense>
                <q-item>
                  <q-item-section side>
                    <q-item-label>
                      Ecuador
                    </q-item-label>
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>
                      {{ store.contact.phone.ecuador }}
                    </q-item-label>
                  </q-item-section>
                </q-item>
                <q-item>
                  <q-item-section side>
                    <q-item-label>
                      US
                    </q-item-label>
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>
                      {{ store.contact.phone.us }}
                    </q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </div>
          </div>
        </div>
      </q-card-section>
    </q-card>

    <q-form @submit.prevent="submit">
      <q-card class="q-mt-md">
        <q-card-section>
          <div class="text-h6 q-mb-md">
            {{ store.contact.form.header }}
          </div>

          <div class="row q-gutter-y-xs">
            <div class="col-12 col-md-4 q-px-xs">
              <q-input
                type="text"
                v-model="form.contact_name"
                :label="store.contact.form.contact_name"
                outlined
                dense
                :rules="[(val) => !!val || 'Name is required']"
              />
            </div>

            <div class="col-12 col-md-4 q-px-xs">
              <q-input
                type="email"
                v-model="form.email"
                :label="store.contact.form.email"
                outlined
                dense
                :rules="[(val) => !!val || 'Email is required']"
              />
            </div>

            <div class="col-12 col-md-4 q-px-xs">
              <q-input
                type="text"
                v-model="form.phone"
                :label="store.contact.form.phone"
                outlined
                dense
                :rules="[(val) => !!val || 'Phone is required']"
                mask="(###) ###-####"
              />
            </div>

            <div class="col-12 q-px-xs">
              <q-input
                type="text"
                v-model="form.subject"
                :label="store.contact.form.subject"
                outlined
                dense
                :rules="[(val) => !!val || 'Subject is required']"
              />
            </div>

            <div class="col-12 q-px-xs">
              <q-input
                type="textarea"
                v-model="form.message"
                :label="store.contact.form.message"
                outlined
                dense
                :rules="[(val) => !!val || 'Message is required']"
              />
            </div>

            <div class="col-12 col-md-6 q-px-xs">
              <q-checkbox
                v-model="form.join_mailing_list"
                :label="store.contact.form.join_mailing_list"
                dense
              />
            </div>

            <div class="col-12 col-md-6 q-px-xs">
              <q-checkbox
                v-model="form.consent"
                :label="store.contact.form.consent"
                dense
              />
            </div>
          </div>
        </q-card-section>
        <q-card-actions align="right">
          <q-btn
            type="submit"
            label="Submit"
            color="primary"
            :disable="!form.consent"
          />
        </q-card-actions>
      </q-card>
    </q-form>
  </div>
</template>

<script setup>
import { Loading, Notify, Screen } from "quasar";
import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";
import { ref } from "vue";

const store = useStore();

const form = ref({
  consent: false,
  email: null,
  join_mailing_list: false,
  message: "",
  contact_name: null,
  phone: null,
  subject: null,
});

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
        action: "contact_submit",
      }
    );

    const response = await store.submitForm({
      path: "/contact",
      token,
      formData: form.value,
    });

    if (response.status == "ok") {
      Notify.create({
        type: "positive",
        message: "Contact submitted successfully!",
      });
    }

  } catch (error) {
    console.error("reCAPTCHA failed:", error);
    Notify.create({
      type: "negative",
      message: "Verification failed. Please try again.",
    });
  }

  Loading.hide();
};
</script>
