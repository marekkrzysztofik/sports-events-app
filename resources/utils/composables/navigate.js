import { useRouter } from 'vue-router';

export function useNavigateTo(path) {
  const router = useRouter();

  function navigateTo() {
    router.push({ path });
  }

  return {
    navigateTo,
  };
}