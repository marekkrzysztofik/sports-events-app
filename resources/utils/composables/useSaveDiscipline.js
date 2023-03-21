import { useRouter } from "vue-router";
import { ref } from "vue";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";

export function useSaveDiscipline() {
    const userInfo = useUserInfo();
    const router = useRouter();
    const date = ref({
        day: "",
        time: "",
    });
    const compStyle = ref({
        style: "",
        competition: "",
    });
    const ageGroup = ref();
    const form = ref({
        name: "",
        user_id: 0,
        minAge: "",
        maxAge: "",
        startTime: "",
        sex: "",
        participants: "",
        timeNotScore: 0,
        bigScoreWins: 0,
    });
    async function saveCompetition() {
        form.value.minAge = ageGroup.value.substr(0, 2);
        form.value.maxAge = ageGroup.value.substr(3, 2);
        form.value.user_id = userInfo.id;
        form.value.startTime = date.value.day + " " + date.value.time;
        form.value.style = compStyle.value.style.cname;
        form.value.competition = compStyle.value.competition.cname;
        await axios
            .post("/api/createOrUpdateDiscipline", { ...form.value })
            .then(() => {
                router.push("/admin");
            });
    }
    return { date, compStyle, form, ageGroup, saveCompetition };
}
