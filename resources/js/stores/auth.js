import { defineStore } from "pinia";
import { authAPI } from "../shared/api/auth";

export const useAuthStore = defineStore("auth", {
    state: () => {
        return {
            isLoading: false,
            error: null,
        };
    },

    actions: {
        async login(credentials) {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await authAPI.login(credentials);
                localStorage.setItem("token", response.data.token);
                localStorage.setItem("user", JSON.stringify(response.data.user));
                console.log("Успешный вход: ", localStorage.getItem("token"));
            } catch (err) {
                console.error("Ошибка входа: ", err);
                localStorage.removeItem("token");
                this.error = err.response?.data?.message || "Ошибка входа";
            } finally {
                this.isLoading = false;
            }
        },

        async logout() {
            this.isLoading = false;
            this.error = null;

            try {
                this.isLoading = true;
                const response = await authAPI.logout();
                localStorage.removeItem("token");
                localStorage.removeItem("user");
                console.log("Успешный выход");
            } catch (err) {
                console.error("Ошибка выхода: ", response.data);
                this.error = err.response?.data?.message || "Ошибка выхода";
            } finally {
                this.isLoading = false;
            }
        }
    },
});
