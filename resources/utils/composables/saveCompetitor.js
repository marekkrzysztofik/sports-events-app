import { ref } from "vue";
import { compForm } from "../consts/form.js";
import { user } from '../../modules/Organizer/composables/user.js'
export const success = ref("");
export const saveCompetitor = async () => {
    compForm.value.user_id = user.value.id 
    await axios
        .post("/api/createOrUpdateSportsman", { ...compForm.value })
        .then(() => {
            Object.keys(compForm.value).forEach(
                (key) => (compForm.value[key] = "")
            );
            success.value = 1;
        });
};
