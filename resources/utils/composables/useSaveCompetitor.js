import { ref } from "vue";
import { useRouter } from "vue-router";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";

export function useSaveCompetitor() {
    const userInfo = useUserInfo();
    const router = useRouter();
    const compForm = ref({
        name: "",
        user_id: "",
        surname: "",
        age: "", 
        sex: "",
    });
    async function saveCompetitor() {
        compForm.value.user_id = userInfo.id;
        await axios
            .post("/api/createOrUpdateSportsman", { ...compForm.value })
            .then(() => {
                router.push("/admin/competitors");
            });
    }
    return { compForm, saveCompetitor };
}
