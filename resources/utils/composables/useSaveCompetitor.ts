import { ref } from "vue";
import { useRouter } from "vue-router";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";
import { CompetitorForm } from "resources/types/forms.ts";
import axios from "axios";

export function useSaveCompetitor() {
    const userInfo = useUserInfo();
    const router = useRouter();
    const competitorForm = ref<CompetitorForm>({
        name: "",
        user_id: "",
        surname: "",
        age: "",
        sex: "",
    });
    async function saveCompetitor() {
        competitorForm.value.user_id = userInfo.id;
        await axios
            .post("/api/createOrUpdateSportsman", { ...competitorForm.value })
            .then(() => {
                router.push("/admin/competitors");
            });
    }
    return { competitorForm, saveCompetitor };
}
