import { useRouter } from "vue-router";
import { ref } from "vue";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";
import { DisciplineForm, Date, CompStyle } from "resources/types/disciplineForms.ts";
import axios from "axios";

export function useSaveDiscipline() {
    const userInfo = useUserInfo();
    // const userInfo = {
    //     id: 18,
    //     type: "Admin",
    // };
    const router = useRouter();
    const date = ref<Date>({
        day: "",
        time: "",
    });
    const compStyle = ref<CompStyle>({
        style: "",
        competition: "",
    });
    const ageGroup = ref<string>();
    const form = ref<DisciplineForm>({
        name: "",
        user_id: 0,
        minAge: 0,
        maxAge: 0,
        style: "",
        competition: "",
        startTime: "",
        sex: "",
        participants: 0,
        timeNotScore: 0,
        bigScoreWins: 0,
    });
    async function saveCompetition() {
        form.value.minAge = parseInt(ageGroup.value?.substr(0, 2) ?? "", 10);
        form.value.maxAge = parseInt(ageGroup.value?.substr(3, 2) ?? "", 10);
        form.value.user_id = userInfo.id;
        form.value.startTime = `${date.value.day} ${date.value.time}`;
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
