import GoogleIcon from "@/icons/GoogleIcon";
import { Head, Link, router } from "@inertiajs/react";
import {
  Anchor,
  Button,
  Center,
  Checkbox,
  Container,
  Divider,
  Group,
  PasswordInput,
  Stack,
  Tabs,
  Text,
  TextInput,
  Title,
  Box,
  ThemeIcon,
  List,
  SimpleGrid,
} from "@mantine/core";
import { useForm } from "laravel-precognition-react-inertia";
import { useRef, useState } from "react";
import {
  IconCheck,
  IconArrowRight,
  IconBrandGoogle,
  IconMail,
  IconLock,
  IconUser,
} from "@tabler/icons-react";
import classes from "./css/Landing.module.css";

const Landing = ({ notify }) => {
  const [activeTab, setActiveTab] = useState("login");
  const [socialLoginPending, setSocialLoginPending] = useState(false);
  const passwordRef = useRef(null);

  const loginForm = useForm("post", route("auth.login.attempt"), {
    email: "",
    password: "",
    remember: false,
  });

  const registerForm = useForm("post", route("auth.register.store"), {
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
  });

  const handleLogin = (e) => {
    e.preventDefault();
    loginForm.submit({ preserveScroll: true });
  };

  const handleRegister = (e) => {
    e.preventDefault();
    registerForm.submit({ preserveScroll: true });
  };

  return (
    <>
      <Head title="CollabX - Collaboration Platform" />
      <div className={classes.wrapper}>
        {/* Hero Section */}
        <div className={classes.hero}>
          <Container size="lg" py={80}>
            <Stack align="center" spacing="xl">
              <div>
                <Title ta="center" className={classes.heroTitle}>
                  Welcome to <span className={classes.highlight}>CollabX</span>
                </Title>
                <Text ta="center" c="dimmed" size="lg" mt="md">
                  Collaborate effortlessly. Manage projects seamlessly.
                  <br />
                  Everything your team needs in one place.
                </Text>
              </div>

              {/* Features Grid */}
              <SimpleGrid cols={{ base: 1, sm: 3 }} spacing="lg" mt={40} mb={40}>
                <Box className={classes.featureBox}>
                  <ThemeIcon size={40} radius="md" variant="light" mb="sm">
                    <IconCheck size={24} />
                  </ThemeIcon>
                  <Text fw={600} mb="xs">
                    Task Management
                  </Text>
                  <Text size="sm" c="dimmed">
                    Track and manage all your tasks efficiently
                  </Text>
                </Box>
                <Box className={classes.featureBox}>
                  <ThemeIcon size={40} radius="md" variant="light" mb="sm">
                    <IconCheck size={24} />
                  </ThemeIcon>
                  <Text fw={600} mb="xs">
                    Team Collaboration
                  </Text>
                  <Text size="sm" c="dimmed">
                    Work together with your team in real-time
                  </Text>
                </Box>
                <Box className={classes.featureBox}>
                  <ThemeIcon size={40} radius="md" variant="light" mb="sm">
                    <IconCheck size={24} />
                  </ThemeIcon>
                  <Text fw={600} mb="xs">
                    Project Tracking
                  </Text>
                  <Text size="sm" c="dimmed">
                    Keep your projects organized and on track
                  </Text>
                </Box>
              </SimpleGrid>
            </Stack>
          </Container>
        </div>

        {/* Auth Section */}
        <Container size={480} py={60}>
          <Tabs value={activeTab} onTabChange={setActiveTab} keepMounted={false}>
            <Tabs.List grow>
              <Tabs.Tab value="login" icon={<IconLock size={14} />}>
                Login
              </Tabs.Tab>
              <Tabs.Tab value="register" icon={<IconUser size={14} />}>
                Sign Up
              </Tabs.Tab>
            </Tabs.List>

            {/* Login Tab */}
            <Tabs.Panel value="login" pt="md">
              <div className={classes.formContainer}>
                <Title order={2} ta="center" mb="xs">
                  Welcome Back
                </Title>
                <Text c="dimmed" size="sm" ta="center" mb={30}>
                  Sign in to your account to continue
                </Text>

                <form onSubmit={handleLogin}>
                  <Stack gap="md">
                    {/* Social Login */}
                    <Button
                      leftSection={<IconBrandGoogle size={16} />}
                      variant="default"
                      fullWidth
                      radius="md"
                      component="a"
                      href={route("auth.login.social.google")}
                      onClick={() => setSocialLoginPending(true)}
                      loading={socialLoginPending}
                    >
                      Continue with Google
                    </Button>

                    <Divider label="Or continue with email" labelPosition="center" />

                    {/* Email Input */}
                    <TextInput
                      label="Email"
                      placeholder="your@email.com"
                      icon={<IconMail size={16} />}
                      value={loginForm.data.email}
                      onChange={(e) => loginForm.setData("email", e.currentTarget.value)}
                      error={loginForm.errors.email}
                      radius="md"
                    />

                    {/* Password Input */}
                    <PasswordInput
                      label="Password"
                      placeholder="Your password"
                      icon={<IconLock size={16} />}
                      ref={passwordRef}
                      value={loginForm.data.password}
                      onChange={(e) => loginForm.setData("password", e.currentTarget.value)}
                      error={loginForm.errors.password}
                      radius="md"
                    />

                    {/* Remember Me & Forgot Password */}
                    <Group justify="space-between" mb="md">
                      <Checkbox
                        label="Remember me"
                        checked={loginForm.data.remember}
                        onChange={(e) => loginForm.setData("remember", e.currentTarget.checked)}
                      />
                      <Anchor component={Link} href={route("auth.forgotPassword.form")} size="sm">
                        Forgot password?
                      </Anchor>
                    </Group>

                    {/* Submit Button */}
                    <Button
                      fullWidth
                      radius="md"
                      loading={loginForm.processing}
                      rightSection={<IconArrowRight size={16} />}
                      onClick={handleLogin}
                    >
                      Sign In
                    </Button>
                  </Stack>
                </form>

                <Text ta="center" mt="md" size="sm">
                  Don't have an account?{" "}
                  <Anchor
                    component="button"
                    type="button"
                    onClick={() => setActiveTab("register")}
                    fw={700}
                  >
                    Create one
                  </Anchor>
                </Text>
              </div>
            </Tabs.Panel>

            {/* Register Tab */}
            <Tabs.Panel value="register" pt="md">
              <div className={classes.formContainer}>
                <Title order={2} ta="center" mb="xs">
                  Create Account
                </Title>
                <Text c="dimmed" size="sm" ta="center" mb={30}>
                  Join CollabX and start collaborating today
                </Text>

                <form onSubmit={handleRegister}>
                  <Stack gap="md">
                    {/* Social Login */}
                    <Button
                      leftSection={<IconBrandGoogle size={16} />}
                      variant="default"
                      fullWidth
                      radius="md"
                      component="a"
                      href={route("auth.login.social.google")}
                      onClick={() => setSocialLoginPending(true)}
                      loading={socialLoginPending}
                    >
                      Sign up with Google
                    </Button>

                    <Divider label="Or sign up with email" labelPosition="center" />

                    {/* Name Input */}
                    <TextInput
                      label="Full Name"
                      placeholder="John Doe"
                      icon={<IconUser size={16} />}
                      value={registerForm.data.name}
                      onChange={(e) => registerForm.setData("name", e.currentTarget.value)}
                      error={registerForm.errors.name}
                      radius="md"
                    />

                    {/* Email Input */}
                    <TextInput
                      label="Email"
                      placeholder="your@email.com"
                      icon={<IconMail size={16} />}
                      value={registerForm.data.email}
                      onChange={(e) => registerForm.setData("email", e.currentTarget.value)}
                      error={registerForm.errors.email}
                      radius="md"
                    />

                    {/* Password Input */}
                    <PasswordInput
                      label="Password"
                      placeholder="Create a strong password"
                      icon={<IconLock size={16} />}
                      value={registerForm.data.password}
                      onChange={(e) => registerForm.setData("password", e.currentTarget.value)}
                      error={registerForm.errors.password}
                      radius="md"
                    />

                    {/* Confirm Password Input */}
                    <PasswordInput
                      label="Confirm Password"
                      placeholder="Confirm your password"
                      icon={<IconLock size={16} />}
                      value={registerForm.data.password_confirmation}
                      onChange={(e) =>
                        registerForm.setData("password_confirmation", e.currentTarget.value)
                      }
                      error={registerForm.errors.password_confirmation}
                      radius="md"
                    />

                    {/* Submit Button */}
                    <Button
                      fullWidth
                      radius="md"
                      loading={registerForm.processing}
                      rightSection={<IconArrowRight size={16} />}
                      onClick={handleRegister}
                    >
                      Create Account
                    </Button>
                  </Stack>
                </form>

                <Text ta="center" mt="md" size="sm">
                  Already have an account?{" "}
                  <Anchor
                    component="button"
                    type="button"
                    onClick={() => setActiveTab("login")}
                    fw={700}
                  >
                    Sign in
                  </Anchor>
                </Text>
              </div>
            </Tabs.Panel>
          </Tabs>
        </Container>
      </div>
    </>
  );
};

export default Landing;
