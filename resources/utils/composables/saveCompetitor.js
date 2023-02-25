import { ref } from "vue";
import { compForm } from "../consts/form.js";
export const success = ref("");
export const saveCompetitor = async () => {
    await axios
        .post("/api/createOrUpdateSportsman", { ...compForm.value })
        .then(() => {
            Object.keys(compForm.value).forEach(
                (key) => (compForm.value[key] = "")
            );
            success.value = 1;
        });
};
