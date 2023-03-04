import {
    getDisciplinesByUserId,
    getCompetitorsByUserId,
} from "../consts/getOrDelete.js";
import { ref } from "vue";
getDisciplinesByUserId();
getCompetitorsByUserId();
export const participationForm = ref({
    discipline_id: [],
    sportsman_id: [],
    score: 0,
    time: '23:59:59',
}); 
export const saveParticipation = async () => {
    await axios
        .post("/api/createOrUpdateParticipation", {
            ...participationForm.value,
        })
        .then(() => {
            success.value = 1;
            Object.keys(participationForm.value).forEach(
                (key) => (participationForm.value[key] = "")
            );
        });
};
 