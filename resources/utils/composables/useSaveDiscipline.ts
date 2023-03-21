import { useRouter } from "vue-router";
import { ref } from "vue";
//import { useUserInfo } from "@/storage/Pinia/userInfo.js";
import { DisciplineForm, Date, CompStyle } from "../../types/forms";
import axios from "axios";

export function useSaveDiscipline() {
    //const userInfo = useUserInfo();
    const userInfo = {
        id: 18,
        type: "Admin",
    };
    const router = useRouter();
    const date = ref<Date>({
        day: "",
        time: "",
    });
    const compStyle = ref<CompStyle>({
        style: {
            cname: "",
        },
        competition: {
            cname: "",
        },
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
        // form.value.style = compStyle.value.style.cname;
        // form.value.competition = compStyle.value.competition.cname;
        form.value.style = "siema";
        form.value.competition = "siema";
        await axios
            .post("/api/createOrUpdateDiscipline", { ...form.value })
            .then(() => {
                // Object.keys(form.value).forEach(
                //     (key) => form.value[key as keyof DisciplineForm] == ""
                // );

                // Object.keys(compStyle.value).forEach(
                //     (key) => (compStyle.value[key as keyof CompStyle] == "")
                // );
                router.push("/admin");
            });
    }
    return { date, compStyle, form, ageGroup, saveCompetition };
}
