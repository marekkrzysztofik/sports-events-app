import { Ref, ref } from "vue";
import axios from "axios";
import { useUserInfo } from "@/storage/Pinia/userInfo.js";
import { CompetitorForm } from "resources/types/competitorForm.ts";

export function useCompetitors() {
    const userInfo = useUserInfo();
    const competitors: Ref<Array<CompetitorForm>> = ref([]);
    async function getCompetitorsByUserId() {
        const response = await axios.get(
            `/api/getSportsmenByUserId/${userInfo.id}`
        );
        competitors.value = response.data;
    }
    return { getCompetitorsByUserId, competitors };
}
