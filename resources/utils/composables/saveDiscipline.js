import { form, compStyle, date } from "../consts/form.js";
import { user } from '../../modules/Organizer/composables/user.js'
import { ref } from "vue";

export const success = ref("");
export const saveCompetition = async () => {
    form.value.user_id = user.value.id 
    form.value.startTime = date.value.day + " " + date.value.time;
    form.value.style = compStyle.value.style.cname;
    form.value.competition = compStyle.value.competition.cname;
    await axios
        .post("/api/createOrUpdateDiscipline", { ...form.value })
        .then(() => {
            Object.keys(form.value).forEach((key) => (form.value[key] = ""));
            Object.keys(compStyle.value).forEach(
                (key) => (compStyle.value[key] = "")
            );
            success.value = 1;
        });
};
 