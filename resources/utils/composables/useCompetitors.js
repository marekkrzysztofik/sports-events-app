import { ref } from "vue";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";

export function useCompetitors() {
    const userInfo = useUserInfo();
    const competitors = ref([]);
    async function getCompetitorsByUserId() {
        const response = await axios.get(
            `/api/getSportsmenByUserId/${userInfo.id}`
        );
        competitors.value = response.data;
    }
    return { getCompetitorsByUserId, competitors };
}
