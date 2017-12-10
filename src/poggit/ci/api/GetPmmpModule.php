<?php

/*
 * Poggit
 *
 * Copyright (C) 2016-2017 Poggit
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace poggit\ci\api;

use poggit\Meta;
use poggit\module\Module;

class GetPmmpModule extends Module {
    public function output() {
        $arg = $this->getQuery();
        if(strpos($arg, "/") !== false) {
            $args = explode("/", $arg);
            $arg = implode("/", array_slice($args, 0, -1));
            $path = $args[count($args) - 1];
        } else $path = "PocketMine-MP.phar";

        if($arg === "html") Meta::redirect("https://jenkins.pmmp.io", true);

        header("Content-Type: text/plain");
        echo <<<EOM
PMMP builds on Poggit are temporarily disabled. Please use the official Jenkins server at <https://jenkins.pmmp.io> for development builds of PMMP.

There is no ETA for bringing back PMMP builds on Poggit.
EOM;

//        $paramTypes = "i";
//        $params = [ProjectBuilder::BUILD_CLASS_DEV];
//        if(ctype_digit($arg)) { // $arg is build number
//            $condition = "internal = ?";
//            $paramTypes .= "i";
//            $params[] = (int) $arg;
//        } elseif(isset($_REQUEST["pr"])) {
//            $condition = "INSTR(cause, ?)";
//            $paramTypes .= "s";
//            $params[] = '"prNumber":' . ((int) $_REQUEST["pr"]) . ","; // hack
//        } elseif(isset($_REQUEST["sha"])) {
//            $condition = "sha = ?";
//            $paramTypes .= "s";
//            $params[] = $_REQUEST["sha"];
//        } else {
//            $condition = "branch = ?";
//            $paramTypes .= "s";
//            $params[] = $arg ?: "master";
//        }
//
//        $rows = Mysql::query("SELECT sha, internal, DATE_FORMAT(created, '%a, %d %b %Y %H:%i:%s GMT') AS lastmod, resourceId FROM builds WHERE projectId = 210 AND class = ? AND ($condition)
//                ORDER BY created DESC LIMIT 1", $paramTypes, ...$params);
//        if(count($rows) === 0) $this->errorNotFound();
//        $row = (object) $rows[0];
//        header("X-Poggit-Build-Number: $row->internal");
//        header("X-PMMP-Commit: $row->sha");
//        header("Last-Modified: $row->lastmod");
//        $module = "r" . substr(Meta::getModuleName(), 8);
//        Meta::redirect("$module/" . ((int) $row->resourceId) . "/" . $path);
    }
}
