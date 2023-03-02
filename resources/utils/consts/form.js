import { ref } from "vue";
export const date = ref({
    day: "",
    time: "",
});
export const compStyle = ref({
    style: "",
    competition: "",
});
export const ageGroup = ref()
export const form = ref({ 
    name: "",
    user_id: "",
    category: "",
    minAge:'',
    maxAge:'',
    startTime: "",
    sex: "",
    participants: "",
    timeNotScore: "",
    bigScoreWins: "", 
});
export const compForm = ref({
    name: "",
    user_id: "",
    surname: "",
    age: "",
    sex: "",
});
export const participationForm = ref({
    discipline_id: "",
    sportsman_id: "",
    score: "",
    time: "",
});
