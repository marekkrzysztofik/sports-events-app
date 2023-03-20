import { ref } from "vue";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";

export function useCompetitions() {
    const userInfo = useUserInfo();
    const competitions = ref([]);
    async function getCompetitionsByUserId() {
        const response = await axios.get(
            `/api/getDisciplinesByUserId/${userInfo.id}`
        );
        competitions.value = response.data;
    }
    return { getCompetitionsByUserId, competitions };
}
