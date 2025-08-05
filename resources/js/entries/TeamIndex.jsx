import React from 'react';
import { createRoot } from 'react-dom/client';
import TeamPage from '../Pages/Teams/TeamPage';


const container = document.getElementById('team-page-root');

if (container) {
  createRoot(container).render(
    <TeamPage></TeamPage>
  );
}
