import FlashNotification from "@/components/FlashNotification";
import { Head } from "@inertiajs/react";
import { Container, Grid, Box, Stack } from "@mantine/core";
import classes from "./css/AuthLayout.module.css";

export default function AuthLayout({ title, children, welcomeTitle, welcomeDescription }) {
  return (
    <>
      <Head title={title} />
      <FlashNotification />

      <div className={classes.wrapper}>
        <Grid gutter={0} className={classes.gridContainer}>
          {/* Left Side - Welcome Section */}
          <Grid.Col span={{ base: 12, sm: 6 }} className={classes.welcomeSection}>
            <Stack gap="xl" justify="center" h="100%">
              <Box>
                <h1 className={classes.welcomeTitle}>CollabX</h1>
                <p className={classes.welcomeSubtitle}>Collaboration Platform</p>
              </Box>
              <Box>
                <h2 className={classes.sectionTitle}>{welcomeTitle}</h2>
                <p className={classes.sectionDescription}>{welcomeDescription}</p>
              </Box>
              <Box className={classes.featureList}>
                <div className={classes.featureItem}>✓ Project Management</div>
                <div className={classes.featureItem}>✓ Task Tracking</div>
                <div className={classes.featureItem}>✓ Team Collaboration</div>
              </Box>
            </Stack>
          </Grid.Col>

          {/* Right Side - Form Section */}
          <Grid.Col span={{ base: 12, sm: 6 }} className={classes.formSection}>
            <Box className={classes.formContainer}>{children}</Box>
          </Grid.Col>
        </Grid>
      </div>
    </>
  );
}
