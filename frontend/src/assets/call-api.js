import { useStore } from "src/stores/store";
import { Notify } from "quasar";
import wretch from "wretch";
import { startsWith } from "lodash-es";

export default ({
  path,
  method,
  payload,
  useAuth = false,
  showError = true,
}) => {
  const store = useStore();

  // initialize language
  const language = startsWith("/admin", path) ? "en" : store.language;

  // Initialize the base request
  let request = useAuth
    ? wretch(`/api/${language}`).auth(`Bearer ${store.token}`)
    : wretch(`/api/${language}`);

  // Handle GET vs. other methods
  if (method === "get" && payload) {
    // Append payload to path for GET (e.g., /api/test/1)

    const payloadValue = Object.values(payload).shift();

    const url = `${path}/${payloadValue}`;

    request = request.url(url);
  } else {
    // For non-GET methods, use payload as the body
    request = request.url(path);
    if (payload) {
      request = request.json(payload); // Set JSON body
    }
  }

  // Execute the request
  return request[method]()
    .json()
    .then((response) => {
      if (response.status == "error" && showError) {
        Notify.create({
          type: "negative",
          message: response.message,
          html: true,
        });

        console.error({ mondayError: response });

        return false;
      }
      return response;
    })
    .catch((e) => {
      return { error: e };
    });
};
