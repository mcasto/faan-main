import callApi from "src/assets/call-api";

export default async ({ path, token, formData }) => {
  const response = await callApi({
    path,
    method: "post",
    payload: { ...formData, recaptcha_token: token },
  });

  return response;
};
