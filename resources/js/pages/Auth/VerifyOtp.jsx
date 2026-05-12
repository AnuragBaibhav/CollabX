import { useState, useEffect } from "react";
import { useForm } from "@inertiajs/react";
import GuestLayout from "@/layouts/GuestLayout";
import ContainerBox from "@/layouts/ContainerBox";
import { Title, Text, PinInput, Button, Group, Anchor, Alert, Stack } from "@mantine/core";
import { IconInfoCircle } from "@tabler/icons-react";

export default function VerifyOtp({ email }) {
  const { data, setData, post, processing, errors } = useForm({
    otp: "",
  });

  const [resendDisabled, setResendDisabled] = useState(false);
  const [resendTimer, setResendTimer] = useState(0);
  const [message, setMessage] = useState("");

  useEffect(() => {
    let interval;
    if (resendDisabled && resendTimer > 0) {
      interval = setInterval(() => {
        setResendTimer((prev) => prev - 1);
      }, 1000);
    } else if (resendTimer === 0 && resendDisabled) {
      setResendDisabled(false);
    }
    return () => clearInterval(interval);
  }, [resendDisabled, resendTimer]);

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route("auth.otp.verify"), {
      preserveScroll: true,
    });
  };

  const handleResend = () => {
    post(route("auth.otp.resend"), {
      email,
      onSuccess: () => {
        setResendDisabled(true);
        setResendTimer(60);
        setMessage("OTP has been resent to your email.");
        setTimeout(() => setMessage(""), 3000);
      },
    });
  };

  return (
    <>
      <Title ta="center">Verify Your Email</Title>
      <Text c="dimmed" size="sm" ta="center" mt={5}>
        We've sent a 6-digit code to <strong>{email}</strong>
      </Text>

      <ContainerBox shadow="md" p={30} mt={30} radius="md">
        {message && (
          <Alert color="green" icon={<IconInfoCircle />} mb={20}>
            {message}
          </Alert>
        )}

        <form onSubmit={handleSubmit}>
          <Stack gap="md">
            <div>
              <Text size="sm" fw={500} mb={8}>
                Enter OTP
              </Text>
              <PinInput
                length={6}
                type="number"
                value={data.otp}
                onChange={(value) => setData("otp", value)}
                error={!!errors.otp}
                placeholder="0"
              />
              {errors.otp && (
                <Text size="sm" c="red" mt={4}>
                  {errors.otp}
                </Text>
              )}
            </div>

            <Button type="submit" fullWidth disabled={processing || data.otp.length !== 6}>
              {processing ? "Verifying..." : "Verify OTP"}
            </Button>

            <Group justify="center">
              <Text size="sm" c="dimmed">
                Didn't receive the code?{" "}
                <Anchor
                  component="button"
                  size="sm"
                  onClick={(e) => {
                    e.preventDefault();
                    handleResend();
                  }}
                  disabled={resendDisabled || processing}
                >
                  {resendDisabled ? `Resend in ${resendTimer}s` : "Resend"}
                </Anchor>
              </Text>
            </Group>

            <Group justify="center">
              <Anchor href={route("auth.login.form")} size="sm">
                Back to Login
              </Anchor>
            </Group>
          </Stack>
        </form>

        <Alert icon={<IconInfoCircle />} mt="xl" color="blue">
          The OTP will expire in 10 minutes.
        </Alert>
      </ContainerBox>
    </>
  );
}

VerifyOtp.layout = (page) => <GuestLayout title="Verify OTP">{page}</GuestLayout>;
