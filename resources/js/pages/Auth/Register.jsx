import GoogleIcon from "@/icons/GoogleIcon";
import AuthLayout from "@/layouts/AuthLayout";
import { router } from "@inertiajs/react";
import {
  Anchor,
  Button,
  Divider,
  Group,
  PasswordInput,
  Stack,
  Text,
  TextInput,
  Title,
} from "@mantine/core";
import { useForm } from "laravel-precognition-react-inertia";
import { useState } from "react";

const Register = () => {
  const [socialLoginPending, setSocialLoginPending] = useState(false);

  const form = useForm("post", route("auth.register.store"), {
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  const submit = (e) => {
    e.preventDefault();
    form.submit({ preserveScroll: true });
  };

  return (
    <AuthLayout
      title="Register"
      welcomeTitle="Join CollabX"
      welcomeDescription="Start collaborating with your team today. Manage projects efficiently and keep everyone on the same page."
    >
      <Stack gap="md">
        <Title order={2} size="h2" ta="center" fw={700}>
          Create Account
        </Title>

        <form onSubmit={submit}>
          <Stack gap="md">
            <Button
              leftSection={<GoogleIcon />}
              variant="default"
              fullWidth
              radius="lg"
              component="a"
              href={route("auth.login.social.google")}
              loading={socialLoginPending}
              onClick={() => setSocialLoginPending(true)}
            >
              Continue with Google
            </Button>

            <Divider label="Or continue with email" labelPosition="center" />

            <TextInput
              label="Full Name"
              placeholder="Enter your full name"
              required
              value={form.data.name}
              onChange={(e) => form.setData("name", e.target.value)}
              onBlur={() => form.validate("name")}
              error={form.errors.name}
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

            <TextInput
              label="Email"
              placeholder="Enter your email address"
              required
              value={form.data.email}
              onChange={(e) => form.setData("email", e.target.value)}
              onBlur={() => form.validate("email")}
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
              label="Password"
              placeholder="Enter password"
              required
              value={form.data.password}
              onChange={(e) => form.setData("password", e.target.value)}
              onBlur={() => form.validate("password")}
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
            >
              Create Account
            </Button>

            <Text size="sm" ta="center" c="dimmed">
              Already have an account?{" "}
              <Anchor
                type="button"
                size="sm"
                onClick={() => router.get(route("auth.login.form"))}
                fw={600}
              >
                Sign in here
              </Anchor>
            </Text>
          </Stack>
        </form>
      </Stack>
    </AuthLayout>
  );
};

Register.layout = (page) => page;

export default Register;
