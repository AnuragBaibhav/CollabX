import React, { useState, useEffect } from "react";
import { useForm } from "@inertiajs/react";
import GuestLayout from "@/Layouts/GuestLayout";

export default function VerifyOtp({ email }) {
  const { data, setData, post, processing, errors, reset } = useForm({
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
      onFinish: () => reset("otp"),
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

  const handleOtpChange = (e) => {
    const value = e.target.value.replace(/\D/g, "").slice(0, 6);
    setData("otp", value);
  };

  return (
    <GuestLayout>
      <div className="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div className="max-w-md w-full space-y-8">
          <div>
            <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
              Verify Your Email
            </h2>
            <p className="mt-2 text-center text-sm text-gray-600">
              We've sent a 6-digit code to
              <span className="font-medium text-gray-900"> {email}</span>
            </p>
          </div>

          {/* Success Message */}
          {message && (
            <div className="rounded-md bg-green-50 p-4">
              <div className="text-sm font-medium text-green-800">{message}</div>
            </div>
          )}

          <form onSubmit={handleSubmit} className="mt-8 space-y-6">
            <div>
              <label htmlFor="otp" className="sr-only">
                Enter OTP
              </label>
              <input
                id="otp"
                type="text"
                inputMode="numeric"
                placeholder="Enter 6-digit OTP"
                maxLength="6"
                value={data.otp}
                onChange={handleOtpChange}
                className={`appearance-none rounded-md relative block w-full px-3 py-2 border placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:z-10 sm:text-sm text-center text-2xl tracking-widest ${
                  errors.otp
                    ? "border-red-500 focus:ring-red-500"
                    : "border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                }`}
              />
              {errors.otp && <p className="mt-1 text-sm text-red-600">{errors.otp}</p>}
            </div>

            <div className="flex items-center justify-between">
              <button
                type="submit"
                disabled={processing}
                className="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {processing ? "Verifying..." : "Verify OTP"}
              </button>
            </div>

            {/* Resend OTP */}
            <div className="text-center">
              <p className="text-sm text-gray-600">
                Didn't receive the code?{" "}
                <button
                  type="button"
                  onClick={handleResend}
                  disabled={resendDisabled || processing}
                  className="font-medium text-indigo-600 hover:text-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                  {resendDisabled ? `Resend in ${resendTimer}s` : "Resend"}
                </button>
              </p>
            </div>

            {/* Back to Login */}
            <div className="text-center">
              <a
                href={route("auth.login.form")}
                className="text-sm font-medium text-indigo-600 hover:text-indigo-500"
              >
                Back to Login
              </a>
            </div>
          </form>

          {/* Info Message */}
          <div className="rounded-md bg-blue-50 p-4">
            <div className="flex">
              <div className="flex-shrink-0">
                <svg
                  className="h-5 w-5 text-blue-400"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                >
                  <path
                    fillRule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clipRule="evenodd"
                  />
                </svg>
              </div>
              <div className="ml-3">
                <p className="text-sm font-medium text-blue-800">
                  The OTP will expire in 10 minutes.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </GuestLayout>
  );
}
