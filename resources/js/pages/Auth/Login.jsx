import GoogleIcon from "@/icons/GoogleIcon";
import AuthLayout from "@/layouts/AuthLayout";
import { router } from "@inertiajs/react";
import {
  Anchor,
  Button,
  Checkbox,
  Divider,
  Group,
  PasswordInput,
  Stack,
  Text,
  TextInput,
  Title,
} from "@mantine/core";
import { useForm } from "laravel-precognition-react-inertia";
import { useEffect, useRef, useState } from "react";
import LoginNotification from "./LoginNotification";

const Login = ({ notify }) => {
  const [socialLoginPending, setSocialLoginPending] = useState(false);
  const passwordRef = useRef(null);

  const form = useForm("post", route("auth.login.attempt"), {
    email: route().params?.email || "",
    password: "",
    remember: false,
  });

  useEffect(() => route().params?.email && passwordRef.current.focus(), []);

  const submit = (e) => {
    e.preventDefault();
    form.submit({ preserveScroll: true });
  };

  return (
    <AuthLayout
      title="Login"
      welcomeTitle="Welcome Back"
      welcomeDescription="Access your projects, manage tasks, and collaborate with your team in real-time."
    >
      <Stack gap="md">
        <Title order={2} size="h2" ta="center" fw={700}>
          Sign In
        </Title>

        <LoginNotification notify={notify} />

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
                "input:focus": {
                  borderColor: "#667eea",
                },
              }}
            />

            <PasswordInput
              ref={passwordRef}
              label="Password"
              placeholder="Enter password"
              required
              value={form.data.password}
              onChange={(e) => form.setData("password", e.target.value)}
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
                "input:focus": {
                  borderColor: "#667eea",
                },
              }}
            />

            <Group justify="space-between" mt="xs">
              <Checkbox label="Remember me" size="sm" />
              <Anchor
                type="button"
                size="sm"
                onClick={() => router.get(route("auth.forgotPassword.form"))}
              >
                Forgot password?
              </Anchor>
            </Group>

            <Button
              type="submit"
              fullWidth
              mt="lg"
              disabled={form.processing}
              radius="lg"
              size="md"
            >
              Sign In
            </Button>

            <Text size="sm" ta="center" c="dimmed">
              Don't have an account?{" "}
              <Anchor
                type="button"
                size="sm"
                onClick={() => router.get(route("auth.register.form"))}
                fw={600}
              >
                Create one now
              </Anchor>
            </Text>
          </Stack>
        </form>
      </Stack>
    </AuthLayout>
  );
};

Login.layout = (page) => page;

export default Login;
