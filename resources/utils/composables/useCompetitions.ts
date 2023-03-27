import { Ref, ref } from "vue";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";
import { DisciplineForm } from "resources/types/forms.ts";
import axios from "axios";

export function useCompetitions() {
    const userInfo = useUserInfo();
    const competitions: Ref<Array<DisciplineForm>> = ref([]);
    async function getCompetitionsByUserId() {
        const response = await axios.get(
            `/api/getDisciplinesByUserId/${userInfo.id}`
        );
        competitions.value = response.data;
    }
    return { getCompetitionsByUserId, competitions };
}
