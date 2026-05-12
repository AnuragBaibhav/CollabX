import GoogleIcon from "@/icons/GoogleIcon";
import ContainerBox from "@/layouts/ContainerBox";
import GuestLayout from "@/layouts/GuestLayout";
import { router } from "@inertiajs/react";
import {
  Anchor,
  Button,
  Divider,
  Group,
  PasswordInput,
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
    <>
      <Title ta="center">Create your account</Title>
      <Text c="dimmed" size="sm" ta="center" mt={5}>
        Join CollabX and start managing your projects
      </Text>

      <form onSubmit={submit}>
        <ContainerBox shadow="md" p={30} mt={30} radius="md">
          <Group grow mb="md" mt="md">
            <Button
              leftSection={<GoogleIcon />}
              variant="default"
              radius="xl"
              component="a"
              href={route("auth.login.social.google")}
              loading={socialLoginPending}
              onClick={() => setSocialLoginPending(true)}
            >
              Google
            </Button>
          </Group>

          <Divider label="Or create with email" labelPosition="center" my="lg" />

          <TextInput
            label="Full Name"
            placeholder="Your full name"
            required
            value={form.data.name}
            onChange={(e) => form.setData("name", e.target.value)}
            onBlur={() => form.validate("name")}
            error={form.errors.name}
          />

          <TextInput
            label="Email"
            placeholder="Your email"
            required
            mt="md"
            value={form.data.email}
            onChange={(e) => form.setData("email", e.target.value)}
            onBlur={() => form.validate("email")}
            error={form.errors.email}
          />

          <PasswordInput
            label="Password"
            placeholder="Create a password"
            required
            mt="md"
            value={form.data.password}
            onChange={(e) => form.setData("password", e.target.value)}
            onBlur={() => form.validate("password")}
            error={form.errors.password}
          />

          <PasswordInput
            label="Confirm Password"
            placeholder="Confirm your password"
            required
            mt="md"
            value={form.data.password_confirmation}
            onChange={(e) => form.setData("password_confirmation", e.target.value)}
            error={form.errors.password_confirmation}
          />

          <Button type="submit" fullWidth mt="xl" disabled={form.processing}>
            Create Account
          </Button>

          <Text size="sm" ta="center" mt="md">
            Already have an account?{" "}
            <Anchor type="button" size="sm" onClick={() => router.get(route("auth.login.form"))}>
              Sign in here
            </Anchor>
          </Text>
        </ContainerBox>
      </form>
    </>
  );
};

Register.layout = (page) => <GuestLayout title="Register">{page}</GuestLayout>;

export default Register;
