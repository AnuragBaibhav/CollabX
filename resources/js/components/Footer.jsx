import { Container, Text } from "@mantine/core";
import classes from "./Footer.module.css";

const Footer = () => {
  return (
    <footer className={classes.footer}>
      <Container size="xl" py={40}>
        <div style={{ textAlign: "center" }}>
          <Text className={classes.brandText} fw={900}>
            CollabX
          </Text>
        </div>
      </Container>
    </footer>
  );
};

export default Footer;
