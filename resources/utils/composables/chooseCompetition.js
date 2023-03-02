import {
    competitions,
    competitors,
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
const disciplineWithCompetitors = ref({});
export const ComptitionIds = [];
export const ComptitorsIds = [];
export let success = ref("");
export const saveParticipation = async () => {
    let stopFunction = false;
    const response = await axios.get(
        `/api/discWithSportsman/${participationForm.value.discipline_id}`
    );
    disciplineWithCompetitors.value = response.data;
    const competitorSex =
        competitors.value[
            ComptitorsIds.indexOf(participationForm.value.sportsman_id)
        ].sex;
    const competitorAge =
        competitors.value[
            ComptitorsIds.indexOf(participationForm.value.sportsman_id)
        ].age;
    const sex =
        competitions.value[
            ComptitionIds.indexOf(participationForm.value.discipline_id)
        ].sex;
    const minAge = competitions.value[
        ComptitionIds.indexOf(participationForm.value.discipline_id)
    ].ageGroup.substr(0, 2);
    const maxAge = competitions.value[
        ComptitionIds.indexOf(participationForm.value.discipline_id)
    ].ageGroup.substr(3, 2);
    if (competitorSex != sex) {
        console.error(
            "Cannot assign competitor to competition because of wrong sex"
        );
        stopFunction = true;
        return;
    }
    if (competitorAge < minAge || competitorAge > maxAge) {
        console.error(
            "Competitor is either too young or too old for this competition"
        );
        stopFunction = true;
        return;
    }
    if (
        disciplineWithCompetitors.value.sportsman.length >=
        disciplineWithCompetitors.value.participants
    ) {
        console.error("This competition is full");
        stopFunction = true;
    }
    disciplineWithCompetitors.value.sportsman.forEach((sportsman) => {
        if (sportsman.id == participationForm.value.sportsman_id) {
            console.error(
                "Competitor with this id is already assigned to this competition"
            );
            stopFunction = true;
            return;
        }
    });
    if (stopFunction) {
        return;
    }
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
