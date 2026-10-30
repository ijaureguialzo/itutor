<?php

/*
  This file is part of iTutor.
  Copyright (C) 2008 Oihane Garcia Bolumburu <oihaneg@gmail.com>
  Copyright (C) 2008 Ion Jaureguialzo Sarasola <widemos@gmail.com>

  iTutor is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  iTutor is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with iTutor. If not, see <http://www.gnu.org/licenses/>.
*/

?>
<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(sfConfig::get('sf_plugins_dir').'/sfGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 2278 2006-10-01 13:30:31Z fabien $
 */ 
class sfGuardAuthActions extends BasesfGuardAuthActions
{
    /**
     * Executes signin action with brute-force rate limiting (P1-H4).
     *
     * Limits the number of sign-in attempts per session to mitigate
     * brute-force attacks against the credentials.
     */
    public function executeSignin()
    {
        if ($this->getRequest()->getMethod() == sfRequest::POST)
        {
            $user = $this->getUser();
            $attempts = (int) $user->getAttribute('login_attempts', 0);
            $last = (int) $user->getAttribute('login_last', 0);
            $now = time();

            if ($now - $last < 300)
            {
                $attempts = $attempts + 1;
                $user->setAttribute('login_attempts', $attempts);

                if ($attempts > 5)
                {
                    // Too many attempts: throttle (P1-H4).
                    $this->getResponse()->setStatusCode(429);
                    return sfView::NONE;
                }
            }
            else
            {
                $user->setAttribute('login_attempts', 1);
            }

            $user->setAttribute('login_last', $now);
        }

        return parent::executeSignin();
    }
}
