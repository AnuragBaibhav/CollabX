import AuthLayout from "@/layouts/AuthLayout";
import { redirectTo } from "@/utils/route";
import {
  Alert,
  Anchor,
  Box,
  Button,
  Center,
  Group,
  Stack,
  Text,
  TextInput,
  Title,
  rem,
} from "@mantine/core";
import { IconArrowLeft, IconInfoCircle } from "@tabler/icons-react";
import { useForm } from "laravel-precognition-react-inertia";

const ForgotPassword = ({ status }) => {
  const form = useForm("post", route("auth.forgotPassword.sendLink"), {
    email: "",
  });

  const submit = (e) => {
    e.preventDefault();
    form.clearErrors();
    form.submit({ preserveScroll: true });
  };

  return (
    <AuthLayout
      title="Forgot Password"
      welcomeTitle="Password Recovery"
      welcomeDescription="Don't worry! We'll help you reset your password and get back to collaborating with your team."
    >
      <Stack gap="md">
        <Title order={2} size="h2" ta="center" fw={700} c="white">
          Forgot Password
        </Title>

        <form onSubmit={submit}>
          <Stack gap="md">
            <Text c="dimmed" size="sm" ta="center">
              Enter your email and we'll send you a password reset link.
            </Text>

            {status && (
              <Alert
                radius="lg"
                title="Check Your Email"
                icon={<IconInfoCircle />}
                color="green"
                styles={{
                  root: { backgroundColor: "rgba(34, 197, 94, 0.1)", borderColor: "#22c55e" },
                  title: { color: "white", fontWeight: 600 },
                  message: { color: "#dbeafe" },
                }}
              >
                We've sent a password reset link to your email. Please check your inbox and follow
                the instructions.
              </Alert>
            )}

            <TextInput
              label="Email"
              placeholder="Enter your email address"
              required
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

            <Button
              type="submit"
              fullWidth
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
              Send Reset Link
            </Button>

            <Group justify="center">
              <Anchor
                c="blue"
                size="sm"
                onClick={() => redirectTo("auth.login.form")}
                style={{ cursor: "pointer" }}
              >
                <Center inline>
                  <IconArrowLeft style={{ width: rem(12), height: rem(12) }} stroke={1.5} />
                  <Box ml={5}>Back to login</Box>
                </Center>
              </Anchor>
            </Group>
          </Stack>
        </form>
      </Stack>
    </AuthLayout>
  );
};

ForgotPassword.layout = (page) => page;

export default ForgotPassword;
