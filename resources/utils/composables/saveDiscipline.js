import { form, compStyle, date } from "../consts/form.js";
import { ref } from "vue";
const booleanToNum = ref({
    timeNotScore:'',
    bigScoreWins:''
})
const booleanToNumber = () => {
    if(booleanToNum.value.timeNotScore==true) {
        form.value.timeNotScore=1
    } 
    if(booleanToNum.value.timeNotScore==false) {
        form.value.timeNotScore=0
    }
    if(booleanToNum.value.bigScoreWins==true) {
        form.value.bigScoreWins=1
    }
    if(booleanToNum.value.bigScoreWins==false) {
        form.value.bigScoreWins=0
    }
    save()
}
export const success = ref("");
export const saveCompetition = async () => {
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
 