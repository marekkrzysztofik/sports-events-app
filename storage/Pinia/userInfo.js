import { defineStore } from "pinia";

export const useUserInfo = defineStore("userInfo", {
    state: () => {
        return {
            id: 18,
            type: "Admin",
        };
    },
    persist: {
        enabled: true,
    },
});
