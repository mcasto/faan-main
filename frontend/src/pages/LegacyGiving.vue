<template>
  <div class="q-pa-md">
    <q-card class="bg-blue-1">
      <q-card-section>
        <div class="row">
          <div class="column col-12 col-md-6 q-pa-sm">
            <div
              class="text-h4 text-bold q-mb-md"
              v-html="store.legacyGiving.headerArea.header"
            ></div>
            <div v-html="store.legacyGiving.headerArea.subtitle"></div>
          </div>
          <div class="col-12 col-md-6 q-pa-sm text-center">
            <q-img :src="store.legacyGiving.headerArea.image" fit="contain" />
          </div>
        </div>
      </q-card-section>
    </q-card>

    <div class="row">
      <div class="col-12 col-md-8 q-pa-sm">
        <div class="column">
          <q-card style="min-height: 260px;">
            <q-card-section>
              <div
                class="text-h6"
                v-html="store.legacyGiving.leftColumn.why.header"
              ></div>
              <img
                :src="store.legacyGiving.leftColumn.why.image"
                fit="contain"
                height="200px"
                :align="Screen.md ? 'left' : ''"
                class="q-pr-md"
              />
              <div v-html="store.legacyGiving.leftColumn.why.text"></div>
            </q-card-section>
          </q-card>
        </div>

        <q-card class="q-mt-md bg-blue-1">
          <q-card-section>
            <div v-html="store.legacyGiving.leftColumn.society"></div>
          </q-card-section>
        </q-card>

        <q-card class="q-mt-md" style="min-height: 260px;">
          <q-card-section>
            <img
              :src="store.legacyGiving.leftColumn.guide.image"
              fit="contain"
              height="200px"
              :align="Screen.md ? 'left' : ''"
              class="q-pr-md"
            />
            <div
              v-html="store.legacyGiving.leftColumn.guide.header"
              class="text-h6 text-bold"
            ></div>
            <q-list>
              <q-item
                v-for="(item, index) in store.legacyGiving.leftColumn.guide
                  .plan"
                :key="index"
              >
                <q-item-section side>
                  <q-badge :label="index + 1"></q-badge>
                </q-item-section>
                <q-item-section>
                  <q-item-label>
                    <div v-html="item"></div>
                  </q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-card-section>
        </q-card>
      </div>

      <div class="col-12 col-md-4 q-pa-sm">
        <q-card>
          <q-card-section>
            <q-card>
              <q-card-section>
                <div
                  class="text-h6 q-mb-md"
                  v-html="store.legacyGiving.rightColumn.heir.header"
                ></div>
                <q-separator spaced></q-separator>
                <div v-html="store.legacyGiving.rightColumn.heir.text"></div>
                <div class="text-center q-mt-md">
                  <q-btn
                    icon="download"
                    :label="store.legacyGiving.rightColumn.heir.buttonLabel"
                    color="primary"
                  />
                </div>
              </q-card-section>
            </q-card>
          </q-card-section>
          <q-card-section>
            <q-card>
              <q-card-section>
                <div
                  class="text-h6"
                  v-html="store.legacyGiving.rightColumn.pledge.header"
                ></div>

                <q-list>
                  <q-item
                    v-for="(item, index) in store.legacyGiving.rightColumn
                      .pledge.items"
                    :key="index"
                  >
                    <q-item-section side top>
                      <q-badge :label="index + 1"></q-badge>
                    </q-item-section>
                    <q-item-section>
                      <q-item-label>
                        <div v-html="item"></div>
                      </q-item-label>
                    </q-item-section>
                  </q-item>
                </q-list>
              </q-card-section>
            </q-card>
          </q-card-section>
        </q-card>
      </div>
    </div>

    <q-card class="q-mt-md">
      <q-toolbar>
        <q-toolbar-title>
          {{ store.legacyGiving.formConfig.title }}
        </q-toolbar-title>
      </q-toolbar>
      <q-separator spaced></q-separator>
      <q-card-section>
        <q-form @submit.prevent="submit">
          <div class="row">
            <q-input
              class="col-12 col-md-6 q-pa-xs"
              :label="store.legacyGiving.formConfig.legal_name_of_donor.label"
              :type="store.legacyGiving.formConfig.legal_name_of_donor.type"
              v-model="form.legal_name_of_donor"
              dense
              outlined
              required
            ></q-input>
            <q-input
              class="col-12 col-md-6 q-pa-xs"
              :label="store.legacyGiving.formConfig.phone.label"
              :type="store.legacyGiving.formConfig.phone.type"
              mask="(###) ###-####"
              v-model="form.phone"
              dense
              outlined
              required
            ></q-input>
            <q-input
              class="col-12 col-md-6 q-pa-xs"
              :label="store.legacyGiving.formConfig.cedula_passport.label"
              :type="store.legacyGiving.formConfig.cedula_passport.type"
              v-model="form.cedula_passport"
              dense
              outlined
              required
            ></q-input>
            <q-input
              class="col-12 col-md-6 q-pa-xs"
              :label="store.legacyGiving.formConfig.email.label"
              :type="store.legacyGiving.formConfig.email.type"
              v-model="form.email"
              dense
              outlined
              required
            ></q-input>
            <q-input
              class="col-12 q-pa-xs"
              :label="store.legacyGiving.formConfig.address.label"
              :type="store.legacyGiving.formConfig.address.type"
              v-model="form.address"
              dense
              outlined
            ></q-input>
            <q-input
              class="col-12 q-pa-xs"
              :label="store.legacyGiving.formConfig.special_instructions.label"
              :type="store.legacyGiving.formConfig.special_instructions.type"
              v-model="form.special_instructions"
              dense
              outlined
            ></q-input>
            <q-select
              :label="store.legacyGiving.formConfig.donation_type.label"
              :options="store.legacyGiving.formConfig.donation_type.options"
              v-model="form.donation_type"
              class="col-12 col-md-6 q-pa-xs"
              dense
              outlined
              :rules="[(v) => !!v || 'Required']"
            ></q-select>
            <legacy-donation-type-followup
              v-model="form.donation_type_followup"
              :donation_type="form.donation_type"
            ></legacy-donation-type-followup>
            <q-checkbox
              v-model="form.recognized"
              :true-value="1"
              :false-value="0"
              class="col-12 col-md-6 q-pa-xs"
              :label="store.legacyGiving.formConfig.recognized.label"
              required
            ></q-checkbox>
            <q-checkbox
              v-model="form.consent"
              :true-value="1"
              :false-value="0"
              class="col-12 col-md-6 q-pa-xs"
              :label="store.legacyGiving.formConfig.consent.label"
              required
            ></q-checkbox>
          </div>
          <q-separator spaced></q-separator>
          <q-card-actions class="justify-between">
            <div v-html="store.legacyGiving.recaptcha"></div>
            <q-btn
              type="submit"
              :label="store.legacyGiving.formConfig.buttonLabel"
              color="primary"
              :disable="!form.consent"
            ></q-btn>
          </q-card-actions>
        </q-form>
      </q-card-section>
    </q-card>
  </div>
</template>

<script setup>
import { Loading, Notify, Screen } from "quasar";
import { useStore } from "src/stores/store";
import { ref } from "vue";
import LegacyDonationTypeFollowup from "src/components/LegacyDonationTypeFollowup.vue";
import callApi from "src/assets/call-api";

const store = useStore();

const form = ref({
  legal_name_of_donor: null,
  phone: null,
  cedula_passport: null,
  email: null,
  address: null,
  special_instructions: "",
  recognized: 0,
  donation_type: null,
  donation_type_followup: null,
  consent: 0,
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
        action: "legacy_submit",
      }
    );

    const response = await store.submitForm({
      path: "/legacy-giving",
      token,
      formData: form.value,
    });

    if (response.status == "ok") {
      Notify.create({
        type: "positive",
        message: "Legacy Giving Intention submitted successfully!",
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
