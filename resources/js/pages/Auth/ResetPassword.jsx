import AuthLayout from "@/layouts/AuthLayout";
import { Button, PasswordInput, Stack, Text, TextInput, Title } from "@mantine/core";
import { useForm } from "laravel-precognition-react-inertia";
import { useEffect } from "react";

const ResetPassword = ({ token }) => {
  const form = useForm("post", route("auth.newPassword.save"), {
    token,
    email: "",
    password: "",
    password_confirmation: "",
  });

  useEffect(() => {
    return () => {
      form.reset("password", "password_confirmation");
    };
  }, []);

  const submit = (e) => {
    e.preventDefault();
    form.clearErrors();
    form.submit({ preserveScroll: true });
  };

  return (
    <AuthLayout
      title="Reset Password"
      welcomeTitle="Reset Your Password"
      welcomeDescription="Create a new password to secure your account and get back to collaborating."
    >
      <Stack gap="md">
        <Title order={2} size="h2" ta="center" fw={700} c="white">
          New Password
        </Title>

        <form onSubmit={submit}>
          <Stack gap="md">
            <Text c="dimmed" size="sm" ta="center">
              Enter your email and create a new password
            </Text>

            <TextInput
              label="Email"
              placeholder="Enter your email address"
              required
              onChange={(e) => form.setData("email", e.target.value)}
              error={form.errors.email}
              radius="lg"
              styles={{
                label: { color: "white", fontWeight: 600, marginBottom: 8 },
                input: {
                  backgroundColor: "#1a1a2e",
                  borderColor: "rgba(102, 126, 234, 0.3)",
                  color: "white",
                  fontSize: 14,
                  padding: "12px 16px",
                },
              }}
            />

            <PasswordInput
              label="New Password"
              placeholder="Enter password"
              required
              value={form.data.password}
              onChange={(e) => form.setData("password", e.target.value)}
              error={form.errors.password}
              radius="lg"
              styles={{
                label: { color: "white", fontWeight: 600, marginBottom: 8 },
                input: {
                  backgroundColor: "#1a1a2e",
                  borderColor: "rgba(102, 126, 234, 0.3)",
                  color: "white",
                  fontSize: 14,
                  padding: "12px 16px",
                },
              }}
            />

            <PasswordInput
              label="Confirm Password"
              placeholder="Confirm password"
              required
              value={form.data.password_confirmation}
              onChange={(e) => form.setData("password_confirmation", e.target.value)}
              error={form.errors.password_confirmation}
              radius="lg"
              styles={{
                label: { color: "white", fontWeight: 600, marginBottom: 8 },
                input: {
                  backgroundColor: "#1a1a2e",
                  borderColor: "rgba(102, 126, 234, 0.3)",
                  color: "white",
                  fontSize: 14,
                  padding: "12px 16px",
                },
              }}
            />

            <Button
              type="submit"
              fullWidth
              mt="lg"
              disabled={form.processing}
              radius="lg"
              size="md"
              styles={{
                root: {
                  background: "linear-gradient(135deg, #0066cc 0%, #0052a3 100%)",
                  "&:hover": { background: "linear-gradient(135deg, #0073e6 0%, #005fbd 100%)" },
                },
              }}
            >
              Reset Password
            </Button>
          </Stack>
        </form>
      </Stack>
    </AuthLayout>
  );
};

ResetPassword.layout = (page) => page;

export default ResetPassword;
