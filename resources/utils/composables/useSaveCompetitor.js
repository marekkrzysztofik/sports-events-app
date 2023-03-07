import { ref } from "vue";
import { useRouter } from "vue-router";
import { user } from '../../modules/Organizer/composables/user.js'

export function useSaveCompetitor() {
    const router = useRouter();
     const compForm = ref({
        name: "",
        user_id: "",
        surname: "",
        age: "",
        sex: "",
    });
    async function saveCompetitor() {
        compForm.value.user_id = user.value.id 
        await axios
            .post("/api/createOrUpdateSportsman", { ...compForm.value })
            .then(() => {
                Object.keys(compForm.value).forEach(
                    (key) => (compForm.value[key] = "")
                );
                router.push("/admin/competitors");
            });
    }
    return { compForm, saveCompetitor }
}


